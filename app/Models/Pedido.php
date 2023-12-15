<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
   

    protected $primaryKey = 'id_ped';


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
