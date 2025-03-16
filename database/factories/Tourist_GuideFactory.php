<?php
namespace Database\Factories;

use App\Models\Tourist_Guide;
use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

class Tourist_GuideFactory extends Factory
{
    protected $model = Tourist_Guide::class;

    public function definition()
    {
        return [
            'name' => $this->faker->firstName(),
            'surname' => $this->faker->lastName(),
            'cin' => $this->faker->unique()->uuid(),
            'address' => $this->faker->address(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone_number' => $this->faker->phoneNumber(),
            'cv' => $this->faker->word() . '.pdf',
            'photo' => $this->faker->imageUrl(),
            'city_id' => City::factory(),
        ];
    }
}
