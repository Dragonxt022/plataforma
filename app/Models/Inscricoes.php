<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscricoes extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantidade_inscritos',
        'valor_curso',
        'subtotal',
        'desconto',
        'total',
        'id_empresa',
        'pdf_caminho',
        'nome_treinamento',
        'id_treinamento',
        'nome_empresa',
        'data_inicio',
        'nome_juridico',
        'cnpj',
        'cep',
        'cidade',
        'bairro',
        'rua',
        'numero',
        'responsavel',
        'telefone',
        'email',
        'data_realizacao',
        'status',
        'data_termino',
    ];
    

    public function treinamento()
    {
        return $this->belongsTo(Treinamento::class, 'id_treinamento');
    }

    
}
