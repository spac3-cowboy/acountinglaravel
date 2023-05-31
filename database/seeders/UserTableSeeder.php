<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Mr. admin',
            'email' => 'x@y.z',
            'password' => bcrypt('12345678'),
            'role' => 'admin'
        ]);

        DB::table('users')->insert([
            'name' => 'Mr. operator',
            'email' => 'operator@gmal.com',
            'password' => bcrypt('12345678'),
            'role' => 'operator'
        ]);
    }
}
