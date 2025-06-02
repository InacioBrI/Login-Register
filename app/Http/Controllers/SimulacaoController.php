<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Simulacao;
use App\Models\Contrato;
use App\Models\Renda;
use App\Models\Gasto;
use Carbon\Carbon;

class SimulacaoController extends Controller
{
    // BEM-VINDO
    public function bemvindo() {
        return view('simulador.bemvindo');
    }
    
    // CONTRATO
    public function contrato() {
        return view('simulador.contrato');
    }

    public function salvarContrato(Request $request) {
        $validated = $request->validate([
            'tipo_contrato' => 'required|string|in:estagio,clt',
        ]);

        Contrato::create([
            'user_id' => auth()->id(),
            'tipo_contrato' => $request->input('tipo_contrato'),
            'tempo_empresa' => $request->input('tempo_empresa'),
            'salario' => $request->input('salario'),
            'outras_rendas' => $request->input('outras_rendas'),
        ]);

        return redirect()->route('simulador.renda');
    }

    // RENDA
    public function renda() {
        return view('simulador.renda');
    }

    public function salvarRenda(Request $request) {
        $data = $request->isJson() ? $request->json()->all() : $request->all();

        $request->validate([
            'salario' => 'nullable|numeric',
            'outras' => 'nullable|numeric',
        ]);

        Renda::create([
            'user_id' => auth()->id(),
            'salario_bruto' => $data['salario'] ?? 0,
            'outras_rendas' => $data['outras'] ?? 0,
        ]);

        return redirect()->route('simulador.gastos');
    }

    // GASTOS
    public function gastos() {
        return view('simulador.gastos');
    }

    public function salvarGastos(Request $request) {
        $user = auth()->user();

        Gasto::create([
            'user_id' => $user->id,
            'moradia' => $request->moradia,
            'alimentacao' => $request->alimentacao,
            'transporte' => $request->transporte,
            'saude' => $request->saude,
            'assinaturas' => $request->assinaturas,
            'lazer' => $request->lazer,
            'educacao' => $request->educacao,
            'investimento' => $request->investimento,
            'outros' => $request->outros
        ]);

        return response()->json(['success' => true]);
    }

    // PLANO-DE-AÇÃO
    public function planoAcao(Request $request)
{
    $user = auth()->user();

    // Pega os dados mais recentes do contrato e gasto
    $contrato = Contrato::where('user_id', $user->id)->latest()->first();
    $gasto = Gasto::where('user_id', $user->id)->latest()->first();

    // Verifica se os dados existem
    if (!$contrato || !$gasto) {
        return redirect()->route('dashboard')->with('error', 'Dados de contrato ou gastos não encontrados.');
    }

    // Calcula a renda total
    $salario = floatval($contrato->salario ?? 0);
    $outrasRendas = floatval($contrato->outras_rendas ?? 0);
    $rendaTotal = $salario + $outrasRendas;

    // Categorias de gastos
    $categorias = [
        'moradia', 'alimentacao', 'transporte', 'saude',
        'assinaturas', 'educacao', 'outros'
    ];

    // Cálculo dos gastos por categoria
    $gastosPorCategoria = [];
    $totalGastos = 0;

    foreach ($categorias as $categoria) {
        $valor = floatval($gasto->$categoria ?? 0);
        $gastosPorCategoria[$categoria] = $valor;
        $totalGastos += $valor;
    }

    // Cálculo do percentual por categoria
    $percentuais = [];
    foreach ($gastosPorCategoria as $categoria => $valor) {
        $percentuais[$categoria] = $totalGastos > 0 ? round(($valor / $totalGastos) * 100, 2) : 0;
    }

    // Agrupa categorias personalizadas
    $percentuaisAgrupados = [
        'essenciais' => round(
            ($percentuais['moradia'] ?? 0) +
            ($percentuais['alimentacao'] ?? 0) +
            ($percentuais['transporte'] ?? 0) +
            ($percentuais['saude'] ?? 0), 2
        ),
        'lazer' => round(
            ($percentuais['assinaturas'] ?? 0) +
            ($percentuais['outros'] ?? 0), 2
        ),
        'investimento' => round($percentuais['educacao'] ?? 0, 2),
    ];

    // Cálculo do comprometimento da renda
    $comprometimentoFinanceiro = $rendaTotal > 0 ? round(($totalGastos / $rendaTotal) * 100, 2) : 0;

    // Salvar simulação
    Simulacao::create([
        'user_id' => $user->id,
        'tipo_contrato' => $contrato->tipo_contrato, // Usar do contrato
        'renda_total' => $rendaTotal,
        'total_gastos' => $totalGastos,
        'percentuais' => json_encode($percentuaisAgrupados),
        'salario' => $salario,
        'analise_gastos' => $analiseGastos ?? 'Nenhuma análise feita',
        'data_hora' => Carbon::now(),
    ]);

    return view('simulador.plano', [
        'rendaTotal' => $rendaTotal,
        'totalGastos' => $totalGastos,
        'gastosPorCategoria' => $gastosPorCategoria,
        'percentuais' => $percentuaisAgrupados,
        'comprometimentoFinanceiro' => $comprometimentoFinanceiro,
    ]);
}

    // ANALISE
    public function analise() {
        $usuarioId = auth()->id();

        $renda = Renda::where('user_id', $usuarioId)->latest()->first();
        $gastos = Gasto::where('user_id', $usuarioId)->latest()->first();

        if (!$renda || !$gastos) {
            return redirect()->route('dashboard')->with('error', 'Dados incompletos.');
        }

        $totalRenda = $renda->salario_bruto + $renda->outras_rendas;

        $essenciais = $gastos->transporte + $gastos->saude + $gastos->educacao;
        $lazer = $gastos->lazer + $gastos->assinaturas;
        $investimento = $gastos->investimento + $gastos->outros;

        $porcentagens = [
            'essenciais' => $totalRenda > 0 ? round(($essenciais / $totalRenda) * 1, 1) : 0,
            'lazer' => $totalRenda > 0 ? round(($lazer / $totalRenda) * 10, 1) : 0,
            'investimento' => $totalRenda > 0 ? round(($investimento / $totalRenda) * 10, 1) : 0,
        ];

        return view('simulador.analise', compact('porcentagens'));
}


    // FINALIZAR
    public function finalizar() {
        return view('simulador.finalizar');
    }

    // DASHBOARD
    public function dashboard()
    {
        $user = auth()->user();
        $simulacoes = Simulacao::with('renda')->where('user_id', $user->id)->latest()->get();

        return view('dashboard', compact('simulacoes'));
    }


    // DELETAR SIMULAÇÃO
    public function destroy($id)
    {
        $simulacao = Simulacao::findOrFail($id);
        $simulacao->delete();

        return redirect()->route('dashboard')->with('success', 'Simulação excluída com sucesso!');
    }

    // EDITAR
    public function edit($id)
    {
        $simulacao = Simulacao::with('renda')->findOrFail($id);
        return view('simulacao.edit', compact('simulacao'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tipo' => 'required|string|max:255',
            'valor' => 'required|numeric|min:0',
            'valor_final' => 'required|numeric|min:0',
        ]);

        $simulacao = Simulacao::findOrFail($id);
        $simulacao->valor_final = $request->valor_final;
        $simulacao->save();

        if ($simulacao->renda) {
            $simulacao->renda->tipo = $request->tipo;
            $simulacao->renda->valor = $request->valor;
            $simulacao->renda->save();
        }

        return redirect()->route('dashboard')->with('success', 'Simulação atualizada com sucesso!');
    }



}
