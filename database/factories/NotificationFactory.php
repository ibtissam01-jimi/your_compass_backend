<?php
namespace Database\Factories;

use App\Models\Notification;
use App\Models\Utilisateur;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory
{
    protected $model = Notification::class;

    public function definition()
    {
        return [
            'message' => $this->faker->sentence(),
            'send_date' => $this->faker->date(),
            'type' => $this->faker->randomElement(['info', 'alert', 'warning']),
            'utilisateur_id' => Utilisateur::factory(),
            'admin_id' => Admin::factory(),
        ];
    }
}

