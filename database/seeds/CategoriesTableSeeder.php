<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::insert(['name' => 'politics']);
        Category::insert(['name' => 'funny']);
        Category::insert(['name' => 'science']);
        Category::insert(['name' => 'films']);
    }
}
