<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrato</title>
    <style>
        body {
            background-color: #1C0033;
            color: white;
            text-align: center;
            background-size: cover;
            font-family: Arial, sans-serif;
        }
        h1 {
            color: #ff914d;
            margin-top: 50px;
        }
        .options {
            display: flex;
            justify-content: center;
            margin: 50px 0;
            gap: 50px;
        }
        .option, .botao-selecao {
            border: 2px solid #ff914d;
            padding: 30px;
            border-radius: 10px;
            width: 250px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .option:hover, .botao-selecao:hover {
            background-color: #fba068;
            transform: scale(1.03);
        }
        .option.selected, .botao-selecao.selecionado {
            background-color: #ff914d;
            color: #1c0826;
            font-weight: bold;
        }
        .centro {
            margin-top: 200px;
        }
        button {
            background-color: #8a65ff;
            color: white;
            border: none;
            padding: 12px 30px;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="centro">

        <form id="formContrato" method="POST" action="{{ route('simulador.contrato.salvar') }}">
            @csrf
            <h1>QUAL O SEU TIPO DE CONTRATO?</h1>
            <div class="options">
                <div class="option" data-tipo="estagio">
                    <h2>Estágio/Outros</h2>
                    <p>Salário Bruto <strong>SEM</strong> desconto no INSS</p>
                </div>
                <div class="option" data-tipo="clt">
                    <h2>CLT</h2>
                    <p>Salário Bruto <strong>COM</strong> desconto no INSS</p>
                </div>
            </div>
            <input type="hidden" name="tipo_contrato" id="tipoContrato" value="">
            <button type="submit">CONTINUAR</button>
        </form>

    </div>

    <script>

    document.addEventListener('DOMContentLoaded', () => {
    // Evento de clique nas opções
    document.querySelectorAll('.option').forEach(option => {
        option.addEventListener('click', () => {
            // Remove seleção anterior
            document.querySelectorAll('.option').forEach(opt => opt.classList.remove('selected'));
            // Adiciona a nova seleção
            option.classList.add('selected');
            // Atualiza o campo hidden
            document.getElementById('tipoContrato').value = option.getAttribute('data-tipo');
        });
    });

    // Evento de envio do formulário
    document.getElementById('formContrato').addEventListener('submit', (e) => {
        if (!document.getElementById('tipoContrato').value) {
            e.preventDefault();
            alert('Por favor, selecione um tipo de contrato antes de continuar.');
        }
        });
    });


    </script>

</body>
</html>
