<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable; 

class Login extends Authenticatable
{
  

    protected $primaryKey = "id_log";
    protected $rememberTokenName = false;
    protected $fillable = [
        'username',
        'password',
        'tipo_log',
    ];
}
