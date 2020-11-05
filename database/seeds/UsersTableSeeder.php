<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => Str::uuid()->toString(),
                'name' => 'Galih as admin',
                'email' => 'galih@mail.com',
                'password' => Hash::make('123'),
                'email_verified_at' => now(),
                'created_at'=> now(),
                'updated_at' => now()
            ]
        ]);
    }
}
