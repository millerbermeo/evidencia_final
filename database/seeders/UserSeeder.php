<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            'id' => 1,
            'email' => 'juan@example.com',
            'password' => bcrypt('123'),
            'rol' => 3
        ]);

        User::insert([
            'id' => 2,
            'email' => 'maria@example.com',
            'password' => bcrypt('123'),
            'rol' => 2
        ]);

        User::insert([
            'id' => 3,
            'email' => 'miller@gmail.com',
            'password' => bcrypt('123'),
            'rol' => 1
        ]);
    }
}
