<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
   
    
    protected $primaryKey = "id_prog";
    protected $fillable = [
       'nom_prog',
       'tipo_prog',
    ];
    protected $attributes = [
        'dia_civ' => 0,
        'dia_int' => 0,
        'pass' => 0,
        'sepe' => 0,
        'nao_serv' => 0,
        'aux_estu' => 0,
        'aux_pesq' => 0,
        'cons' => 0,
        'ser_ter' => 0,
        'tran' => 0,
        'total' => 0,
        'edit' => true,
    ];

}
