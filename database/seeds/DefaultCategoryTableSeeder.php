<?php

use Illuminate\Database\Seeder;

class DefaultCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\Category::create([
            'category_name' => 'Makanan'
        ]);

        App\Category::create([
            'category_name' => 'Minuman'
        ]);
    }
}
