<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'Admin',
            'email'=> 'admin@gmail.com',
            'phone'=>'099999999',
            'address'=>'Pyay',
            'role'=>'admin',
            'gender'=>'male',
            'password'=>Hash::make('Admin123')
        ]);
    }
}
