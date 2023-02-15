<?php

namespace Database\Seeders;

use App\Models\User;
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
        $admin = User::create([
            'nama' => 'Superadmin',
            'email' => 'superadmin@boxing.app',
            'password' => bcrypt('superadmin123'),
            'level' => 'admin',
        ]);
        $trainer = User::create([
            'nama' => 'Trainer',
            'email' => 'trainer@boxing.app',
            'password' => bcrypt('trainer123'),
            'level' => 'trainer',
        ]);
        $member = User::create([
            'nama' => 'Member',
            'email' => 'member@boxing.app',
            'password' => bcrypt('member123'),
            'level' => 'member',
        ]);
    }
}
