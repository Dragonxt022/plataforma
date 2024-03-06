<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Notas; 


class CategoriaNota extends Model
{
    protected $fillable = [];

    // Relacionamento com as notas
    public function notas()
    {
        return $this->hasMany(Notas::class, 'id_notas_categoria');
    }
}
