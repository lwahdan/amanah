<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\ServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServiceProvider>
 */
class ServiceProviderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = ServiceProvider::class;

    public function definition(): array
    {
        return [
            'user_id' => User::where('role', 'provider')->inRandomOrder()->first()->id,
            'bio' => $this->faker->sentence(),
            'certifications' => null,
            'specialty' => $this->faker->jobTitle,
            'hourly_rate' => $this->faker->randomFloat(2, 15, 50),
            'availability' => $this->faker->randomElement(['Weekdays', 'Weekends']),
            'phone' => substr($this->faker->phoneNumber, 0, 15), // Trim to 15 characters
            'status' => 'active',
        ];
    }
}
