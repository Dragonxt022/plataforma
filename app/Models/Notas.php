<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Notas extends Model
{
    protected $fillable = ['nome_nota', 'link_arquivo', 'data_vencimento', 'id_notas_categoria', '']; // Campos que podem ser preenchidos em massa

    // Relacionamento com a categoria
    public function categoria()
    {
        return $this->belongsTo(CategoriaNota::class, 'categoria_notas');
    }
}
