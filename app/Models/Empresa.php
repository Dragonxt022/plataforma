<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Empresa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'cnpj',
        'endereco',
        'numero', 
        'bairro',
        'cep', 
        'banco',
        'conta',
        'beneficiario',
        'cabecalho', 
        'rodape',
        'id_empresa,'

    ];

    // protected $guarded = [];


}
