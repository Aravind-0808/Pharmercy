<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            // [
            //     'name' => 'Admin',
            //     'email' => 'admin@gmail.com',
            //     'password' => Hash::make('admin@001'),
            //     'role_id' => 3, // Admin role
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'name' => 'Seller',
            //     'email' => 'seller@gmail.com',
            //     'password' => Hash::make('seller@001'),
            //     'role_id' => 2, // Seller role
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'name' => 'User',
            //     'email' => 'user@gmail.com',
            //     'password' => Hash::make('user@001'),
            //     'role_id' => 1, // User role
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            [
                'name' => 'Test seller',
                'email' => 'testseller@gmail.com',
                'password' => Hash::make('testseller@001'),
                'role_id' => 2, // Seller role
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Test seller 2',
                'email' => 'testseller2@gmail.com',
                'password' => Hash::make('testseller2@001'),
                'role_id' => 2, // Seller role
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Test seller 3',
                'email' => 'testseller3@gmail.com',
                'password' => Hash::make('testseller3@001'),
                'role_id' => 2, // Seller role
                'created_at' => now(),
                'updated_at' => now(),
            ]


        ]);
    }

}
