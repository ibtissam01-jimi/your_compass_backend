<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cities')->insert([
            'name' => 'Tanger',
            'description' => 'A vibrant port city in northern Morocco, known for its blend of cultures, historic medina, and stunning views of the Mediterranean.',
            'image' => 'images/cities/m1.jpg',
            'location' => '35.767234,-5.799750' 

            
        ]);

        DB::table('cities')->insert([
            'name' => 'Marrakech',
            'description' => 'A lively imperial city famous for its red-walled medina, souks, palaces, and the bustling Jemaa el-Fnaa square.',
            'image' => 'images/cities/m2.jpg',
            'location' => '35.767234,-5.799750' 
        ]);

        DB::table('cities')->insert([
            'name' => 'Fez',
            'description' => 'Home to one of the oldest universities in the world, Fez is a cultural and spiritual capital known for its ancient medina and artisans.',
             'image' => 'images/cities/m3.jpg',
             'location' => '35.767234,-5.799750' 
        ]);

        DB::table('cities')->insert([
            'name' => 'Rabat',
            'description' => 'The capital of Morocco, Rabat is a coastal city with historical landmarks, modern architecture, and political institutions.',
            'image' => 'images/cities/m4.jpg',
            'location' => '35.767234,-5.799750' 
        ]);

        DB::table('cities')->insert([
            'name' => 'Agadir',
            'description' => 'A beach resort city on the Atlantic Ocean, Agadir is popular for its sunny weather, seaside promenade, and laid-back vibe.',
            'image' => 'images/cities/m5.jpg',
            'location' => '35.767234,-5.799750' 
        ]);
    }
}
