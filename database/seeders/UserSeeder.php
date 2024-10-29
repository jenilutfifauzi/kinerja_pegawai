<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Kepdes',
                'username' => 'kepdes1',
                'email' => 'kepdes@gmail.com',
                'password' => bcrypt('password'),
                'level' => 'kepdes',
            ]
        ];

        foreach ($data as $key => $value) {
            User::create($value);
        }
    }
}
