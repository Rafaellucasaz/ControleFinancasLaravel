<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coordenador extends Model
{
    use HasFactory;

    protected $table = 'coordenadores';
    
    protected $primaryKey = 'id_logfk';

    protected $fillable = [
        'id_logfk',
        'id_progfk',
        'nome',
    ];
}
