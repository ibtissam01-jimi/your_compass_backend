<?php
namespace Database\Factories;

use App\Models\Service;
use App\Models\City;
use App\Models\Categorie;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    protected $model = Service::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'description' => $this->faker->paragraph(),
            'location' => $this->faker->address(),
            'added_date' => $this->faker->date(),
            'website_link' => $this->faker->url(),
            'city_id' => City::factory(),
            'category_id' => Categorie::factory(),
        ];
    }
}
