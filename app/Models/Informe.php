<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informe extends Model
{
    use HasFactory;

    protected $table = 'informe';

    protected $fillable = [
        'entrada_id',
        'salida_id',
        'fecha_informe'
    ];
}
