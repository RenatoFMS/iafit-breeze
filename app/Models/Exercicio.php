<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercicio extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'grupo_muscular',
        'articulacoes_monitoradas',
        'angulo_ideal',
        'dificuldade',
        'descricao_correcao',
        'ativo',
    ];
}