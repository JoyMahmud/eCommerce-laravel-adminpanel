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
        DB::table('users')->insert([
            'first_name' => 'Supper',
            'last_name' => 'Admin',
            'email' => 'admin@ecommerce.com',
            'password' => bcrypt('ecommerce@'),
            'gender' => 'male',
            'role' => 'super_admin',
            'country' => 'Bangladesh',
        ]);
    }
}
