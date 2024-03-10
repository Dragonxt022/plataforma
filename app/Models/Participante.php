<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participante extends Model
{
    use HasFactory;

    protected $fillable = ['inscricao_id', 'id_treinamento', 'nome', 'celular', 'email'];


    public function inscricao()
    {
        return $this->belongsTo(Inscricoes::class, 'inscricao_id');
    }
}
