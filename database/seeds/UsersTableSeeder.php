<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        $timestamp = now('asia/jakarta');

        DB::table('users')->insert([
            'name' => "Administrator",
            'email' => "administrator@email.com",
            'password' => Hash::make('password'),
            'role_id' => '1',
            'created_at' => $timestamp
        ]);
    }
}
