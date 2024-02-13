<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $timestamp = now('asia/jakarta');

        DB::table('roles')->insert([
        [
            'name_role' => "admin",
            'created_at' => $timestamp,
            'updated_at' => $timestamp,
        ],
         [
            'name_role' => "user",
            'created_at' => $timestamp,
            'updated_at' => $timestamp,
         ]]);
        
    }
}
