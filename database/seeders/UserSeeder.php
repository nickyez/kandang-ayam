<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        User::insert(
            [
                [
                    'name' => 'Admin',
                    'username'=> 'admin',
                    'email' => 'admin'.'@gmail.com',
                    'password' => Hash::make('admin'),
                    'is_admin'=> 1,
                    'photos_url'=> "undraw_profile.svg"
                ],
                [
                    'name' => 'User',
                    'username'=> 'user',
                    'email' => 'user'.'@gmail.com',
                    'password' => Hash::make('user'),
                    'is_admin'=> 0,
                    'photos_url'=> "undraw_profile.svg"
                ]
            ]
        );
    }
}
