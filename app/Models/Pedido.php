<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_progfk';

    public $incrementing = false;

    protected $fillable = [
        'id_progfk',
        'tipo_ped',
        'num_ped',
        'data',
        'val',
        'pcdp',
        'det',
        'ben',
    ];

    protected $attributes = [
        'prest' => ' ' 
    ];
}
