<?php
namespace Database\Factories;

use App\Models\Comment;
use App\Models\Utilisateur;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition()
    {
        return [
            'content' => $this->faker->paragraph(),
            'publication_date' => $this->faker->date(),
            'status' => $this->faker->randomElement(['approved', 'pending', 'rejected']),
            'utilisateur_id' => Utilisateur::factory(),
            'service_id' => Service::factory(),
        ];
    }
}
