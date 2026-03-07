<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeerder extends Seeder
{
 
    public function run(): void
    {
        $user = [
            'name'=>'Thembo Charles',
            'email'=>'thembo.charles@outlook.com',
            'phone'=>'0787440099',
            'password'=> Hash::make('admin123@'),
            'role'=>'admin',
        ];

        User::firstOrCreate(
            [
            'email'=>'thembo.charles@outlook.com',
            'phone'=>'0787440099',
            ],
            $user);
    }
}
