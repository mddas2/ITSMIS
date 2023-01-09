<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class UserSeeder extends Seeder
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
                'username' => 'admin',
                'email' => 'admin@me.com',
                'username' => 'admin',
                'password' => bcrypt('admin'),
                'role_id' => 1,
            ]
        ]);
    }
}
