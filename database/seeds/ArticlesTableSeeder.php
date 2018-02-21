<?php

use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    private $string = 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.

The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.
                                ';
    public function run()
    {
        DB::table('articles')->insert([
            'title' => 'About Us',
            'details' => $this->string,
            'type' => 'about'
        ]);
        DB::table('articles')->insert([
            'title' => 'How To Buy',
            'details' => $this->string,
            'type' => 'buy'
        ]);
        DB::table('articles')->insert([
            'title' => 'Terms And Conditions',
            'details' => $this->string,
            'type' => 'terms'
        ]);
        DB::table('articles')->insert([
            'title' => 'Privacy Policy',
            'details' => $this->string,
            'type' => 'policy'
        ]);
        DB::table('articles')->insert([
            'title' => 'Pre Order',
            'details' => $this->string,
            'type' => 'pre_order'
        ]);
        DB::table('articles')->insert([
            'title' => 'Product Request',
            'details' => $this->string,
            'type' => 'request'
        ]);
    }
}
