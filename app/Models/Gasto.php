<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gasto extends Model
{
    use HasFactory;

    protected $table = 'gastos';

    protected $fillable = [
        'user_id',
        'moradia',
        'alimentacao',
        'transporte',
        'saude',
        'assinaturas',
        'lazer',
        'educacao',
        'investimento',
        'outros',
    ];
}
