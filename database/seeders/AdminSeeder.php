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
            'username' => 'glauber',
            'password' => hash::make('rafa3104'),
            'tipo_log' => 'admin'
        ];
        Login::create($data);

        $data=[
            'username' => 'antonio',
            'password' => hash::make('vivi3104'),
            'tipo_log' => 'admin'
        ];
        Login::create($data);
    }
}
