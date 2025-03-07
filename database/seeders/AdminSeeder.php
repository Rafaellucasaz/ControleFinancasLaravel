<?php

namespace Database\Seeders;

use App\Models\Login;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    
    public function run(): void
    {
        $data=[
            'username' => 'usuario1',
            'password' => hash::make('senha123'),
            'tipo_log' => 'admin'
        ];
        Login::create($data);

        $data=[
            'username' => 'usuario2',
            'password' => hash::make('senha321'),
            'tipo_log' => 'admin'
        ];
        Login::create($data);
    }
}
