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
        'det',
        'ben',
        'pcdp',
        'prest',
    ];

    protected $attributes =[
        'pcdp' => '',
        'prest' => ''
    ];

    protected static function booted()
    {
        static::creating(function ($pedido) {
            $pedido->pcdp = $pedido->pcdp ?? $pedido->getDefaultPcdp();
            $pedido->prest = $pedido->prest ?? $pedido->getDefaultPrest();
        });
    }

    private function getDefaultPcdp()
    {
        return $this->attributes['pcdp'] ?? ''; 
    }

    private function getDefaultPrest()
    {
        return $this->attributes['prest'] ?? '';
    }

}
