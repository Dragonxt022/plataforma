<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participante extends Model
{
    use HasFactory;

    protected $fillable = [
        'inscricao_id', 
        'nome', 
        'celular', 
        'email', 
        'id_treinamento'
    ];
}
