<?php

use Illuminate\Database\Seeder;

class OptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('options')->insert([
            'option_key' => 'logo',
            'option_value' => '/brand_image/logo/logo.png'
        ]);
    }
}
