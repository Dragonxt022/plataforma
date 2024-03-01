<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treinamento extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'nome',
    //     'descricao',
    //     'data_inicio',
    //     'data_termino',
    //     'valor',
    //     'vagas',
    //     'local',
    //     'id_empresa',
    //     'docente',
    //     'banner',
    // ];
    

    protected $guarded = [];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'id_empresa');
    }

}
