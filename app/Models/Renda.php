<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Renda extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'salario_bruto',
        'outras_rendas',
    ];
    public function simulacao()
    {
        return $this->belongsTo(Simulacao::class);
    }
}
