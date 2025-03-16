<?php

namespace Database\Factories;

use App\Models\Favorite;
use App\Models\Utilisateur;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class FavoriteFactory extends Factory
{
    protected $model = Favorite::class;

    public function definition()
    {
        return [
            'utilisateur_id' => Utilisateur::factory(),
            'service_id' => Service::factory(),
        ];
    }
}
