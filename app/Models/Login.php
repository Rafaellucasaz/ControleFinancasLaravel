<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; 

class Login extends Authenticatable
{
    use HasFactory;

    protected $primaryKey = "id_log";
    protected $rememberTokenName = false;
    protected $fillable = [
        'username',
        'password',
        'tipo_log',
    ];
}
