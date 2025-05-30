<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Simulacao extends Model
{
    protected $table = 'simulacoes';

    protected $fillable = [
        'user_id',
        'tipo_contrato',
        'salario',
        'outras_rendas',
        'total_gastos',
        'plano',
        'analise_gastos',
        'data_hora',
        'valor_final',
    ];
    protected $casts = [
    'plano' => 'array',
    'analise_gastos' => 'array',
    'data_hora' => 'datetime',
    
];

    public function renda()
    {
        return $this->hasOne(Renda::class, 'simulacao_id'); // ou 'id' dependendo da sua estrutura
    }

}
