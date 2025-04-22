<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            'name' => 'hotels',
            'description' => 'hotels category with different hotels around the world',
            'image' => '/images/cities/m1.jpg',
        ]);

        DB::table('categories')->insert([
            'name' => 'restaurents',
            'description' => 'discover restaurents that offer delicius food with different hotels around the world',
            'image' => '/images/cat/categorie1.jpg',
        ]);

        DB::table('categories')->insert([
            'name' => 'car Rentals',
            'description' => 'are you in a vacation and want to rent a car, this place is for you',
            'image' => '/images/cat/categorie2.jpg',
        ]);

        DB::table('categories')->insert([
            'name' => 'activities',
            'description' => 'see the most iconique activitis that you can do in a city',
            'image' => '/images/cat/categorie3.jpg',
        ]);
    }
}
