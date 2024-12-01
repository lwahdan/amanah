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
            'user_id' => User::factory(), // Create a related user
            'bio' => $this->faker->sentence(10),
            'certifications' => json_encode([$this->faker->word . ' Certified']),
            'gender' => $this->faker->randomElement(['Male', 'Female']),
            'date_of_birth' => $this->faker->date('Y-m-d', '2000-01-01'),
            'years_of_experience' => $this->faker->numberBetween(1, 20),
            'education' => $this->faker->randomElement([
                'Diploma in Early Childhood Education',
                'Bachelor of Nursing',
                'Certified Caregiver Program',
            ]),
            'skills' => json_encode($this->faker->randomElements(
                ['Childcare', 'First Aid', 'Patient Care', 'Time Management'],
                $this->faker->numberBetween(1, 3)
            )),
            'languages_spoken' => json_encode($this->faker->randomElements(
                ['English', 'Arabic', 'French'],
                $this->faker->numberBetween(1, 2)
            )),
            'availability' => json_encode([
                'Monday: ' . $this->faker->time('H:i') . '-' . $this->faker->time('H:i'),
                'Wednesday: ' . $this->faker->time('H:i') . '-' . $this->faker->time('H:i'),
            ]),
            'hourly_rate' => $this->faker->randomFloat(2, 10, 50),
            'work_shifts' => json_encode($this->faker->randomElements(
                ['Day Shift', 'Night Shift', 'Stay-In'],
                $this->faker->numberBetween(1, 2)
            )),
            'work_locations' => json_encode($this->faker->randomElements(
                ['Amman', 'Irbid', 'Zarqa'],
                $this->faker->numberBetween(1, 3)
            )),
            'background_checked' => $this->faker->boolean(80),
        ];
    }
}
