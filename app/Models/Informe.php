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

    public function entrada()
    {
        return $this->belongsTo(Entrada::class, 'entrada_id');
    }

    public function salida()
    {
        return $this->belongsTo(Salida::class, 'salida_id');
    }
}
