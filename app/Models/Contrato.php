<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tipo_contrato',
        'tempo_empresa',
        'salario',
        'outras_rendas',
    ];
}
