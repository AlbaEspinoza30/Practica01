<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    use HasFactory;
    protected $table="entrada";
    
    protected $fillable = [
        'evento_id',
        'pago',
        'dni',
    ];
}
