<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder{
    public function run(): void{
        User::create([
            'role'      => 'superadmin',
            'status'    => 'true',
            'name'      => 'Elshod Musurmonov',
            'phone'     => '+998901234567', // Bu yerga o'z raqamingizni yozing
            'phone_two' => null,
            'addres'    => 'Qarshi shahar',
            'salary'    => 0,
            'tkun'      => '1995-01-01',
            'pasport'   => 'AB1234567',
            'about'     => 'Tizimning boshqaruvchisi (Superadmin)',
            'password'  => Hash::make('password'), // Tizimga kirish uchun parol
        ]);
    }
}
