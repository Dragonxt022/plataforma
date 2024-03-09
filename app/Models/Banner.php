<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'subtitulo',
        'paragrafo',
        'img_banner',
        'link_botao',
    ];
}
