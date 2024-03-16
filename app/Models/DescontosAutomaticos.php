<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DescontosAutomaticos extends Model
{
    use HasFactory;

    protected $fillable = [
        'valor_1',
        'valor_2',
        'valor_3',
        'valor_4',
        'valor_5',
        'mais_de_5',
    ];
}