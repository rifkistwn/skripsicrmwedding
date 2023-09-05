<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userAdmin = User::create([
            'name' => 'Admin Role',
            'email' => 'admin@test.com',
            'password' => bcrypt('abc'),
            'status' => User::ACTIVE
        ]);

        $userAdmin->assignRole('admin');

        $userGuest = User::create([
            'name' => 'Client Role',
            'email' => 'client@test.com',
            'password' => bcrypt('abc'),
            'status' => User::ACTIVE
        ]);

        $userGuest->assignRole('client');
    }
}
