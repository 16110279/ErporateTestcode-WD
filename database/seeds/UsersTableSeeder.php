<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\User::create([
            'name' => 'Jaka',
            'email' => 'jaka@erporate.com',
            'password' =>  \Hash::make("erporate"),
            'role' => 3,
            'avatar' => 'default.jpg',
            'status' => 'Aktif'
        ]);

        App\User::create([
            'name' => 'Santoso',
            'email' => 'santoso@erporate.com',
            'password' =>  \Hash::make("erporate"),
            'role' => 2,
            'avatar' => 'default.jpg',
            'status' => 'Aktif'
        ]);

        App\User::create([
            'name' => 'Budi',
            'email' => 'budi@erporate.com',
            'password' =>  \Hash::make("erporate"),
            'role' => 3,
            'avatar' => 'default.jpg',
            'status' => 'Aktif'
        ]);
    }
}
