<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitante extends Model
{
    protected $fillable = [
        'nome',
        'data',
        'rg',
        'hora_entrada',
        'hora_saida',
        'empresa',
        'pessoa_visitada',
    ];
}
