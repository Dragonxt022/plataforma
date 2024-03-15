<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treinamento extends Model
{
    use HasFactory;

    

    protected $guarded = [];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'id_empresa');
    }

    public function inscricoes()
    {
        return $this->hasMany(Inscricoes::class, 'id_treinamento');
    }

}
