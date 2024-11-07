<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salida extends Model
{
    use HasFactory;

    protected $table = 'salida';

    protected $fillable = [
        'producto_id',
        'fecha_salida',
        'motivo',
        'cantidad'
    ];
}
