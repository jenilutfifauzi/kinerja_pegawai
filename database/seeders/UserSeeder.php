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
                'name' => 'Kepsek',
                'username' => 'kepsek1',
                'email' => 'kepsek@gmail.com',
                'password' => bcrypt('password'),
                'level' => 'kepsek',
            ]
        ];

        foreach ($data as $key => $value) {
            User::create($value);
        }
    }
}
