<?php
namespace Database\Factories;

use App\Models\Membre;
use Illuminate\Database\Eloquent\Factories\Factory;

class MembreFactory extends Factory
{
    protected $model = Membre::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
        ];
    }
}
