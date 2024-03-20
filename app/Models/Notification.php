<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'read_at',
    ];

    // Definir o acesso ao campo read_at como um Carbon instance
    protected $dates = ['read_at'];
}
