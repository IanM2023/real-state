<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();
    
        DB::table('users')->insert([
            // Admin
            [
                'name'       => 'Admin',
                'username'   => 'admin',
                'email'      => 'admin@gmail.com',
                'password'   => Hash::make('123456'),
                'role'       => 'admin',
                'status'     => 'active',
                'photo'      => 'default_image.jpg',
                'about'      => 'Administrator of the platform.',
                'address'    => '123 Admin Street, Admin City',
                'website'    => 'https://adminsite.com',
                'token'      => '',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Agent
            [
                'name'       => 'Agent',
                'username'   => 'agent',
                'email'      => 'agent@gmail.com',
                'password'   => Hash::make('123456'),
                'role'       => 'agent',
                'status'     => 'active',
                'photo'      => 'default_image.jpg',
                'about'      => 'Handles client interactions and supports users.',
                'address'    => '456 Agent Avenue, Agent City',
                'website'    => 'https://agentsite.net',
                'token'      => '',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // User
            [
                'name'       => 'User',
                'username'   => 'user',
                'email'      => 'user@gmail.com',
                'password'   => Hash::make('123456'),
                'role'       => 'user',
                'status'     => 'active',
                'photo'      => 'default_image.jpg',
                'about'      => 'Just a regular user exploring the platform.',
                'address'    => '789 User Road, Userville',
                'website'    => 'https://usersite.org',
                'token'      => '',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
    
}
