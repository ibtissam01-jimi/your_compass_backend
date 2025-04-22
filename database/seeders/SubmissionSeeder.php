<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('service_submissions')->insert([
            'name' => 'Hyatt Regency',
            'description' => 'Le Hyatt Regency Casablanca compte 255 chambres et suites...',
            'website' => 'https://www.hyatt.com',
            'address' => 'agadir taghazout',
            'email' => 'hyattregency@gmail.com',
            'status' => 'pending',
            'phone_number' => '+212625457896',
            'user_id' => 2,
            'city_id' => 5,
            'category_id' => 3,
           
            
        ]);
    }
}
