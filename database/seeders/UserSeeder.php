<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=>'user'.rand(0,1999),
            'email'=>'mail@'.rand(0,1999).'@gamil.com',
            'password'=>Hash::make('123456'),
        ])->comments()->create([
            'body'=>Str::random(10),
        ]);
    
    }
}
