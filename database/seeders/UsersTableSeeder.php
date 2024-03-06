<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Facades\Hash;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
        DB::table('users')->insert([

            // Admin
            [

                'name' => 'Bruno da Silva',
                'username' => 'Super',
                'email' => 'pissinatti2019@gmail.com',
                'password' => Hash::make('CmCujubim@2021'),
                'role' => 'admin',
                'status' => 'active',

            ],

            // Agente
            [

                'name' => 'Agent',
                'username' => 'agent',
                'email' => 'agent@gmail.com',
                'password' => Hash::make('111'),
                'role' => 'agent',
                'status' => 'active',

            ],


            // User
            [

                'name' => 'User',
                'username' => 'user',
                'email' => 'user@gmail.com',
                'password' => Hash::make('111'),
                'role' => 'user',
                'status' => 'active',

            ],



        ]);

    }
}
