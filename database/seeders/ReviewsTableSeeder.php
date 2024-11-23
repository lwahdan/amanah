<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Review;
use App\Models\Service;
use App\Models\ServiceProvider;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch required data
        $userIds = User::pluck('id')->toArray();
        $serviceIds = Service::pluck('id')->toArray();
        $serviceProviderIds = ServiceProvider::pluck('id')->toArray();

        // Seed 20 reviews
        foreach (range(1, 20) as $index) {
            Review::create([
                'user_id' => $this->getRandomElement($userIds),
                'service_id' => $this->getRandomElement($serviceIds),
                'service_provider_id' => $this->getRandomElement($serviceProviderIds),
                'review' => fake()->sentence(10),
                'rating' => rand(1, 5),
                'status' => ['pending', 'approved', 'disapproved'][array_rand(['pending', 'approved', 'disapproved'])],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Helper function to get a random element from an array.
     */
    private function getRandomElement(array $array)
    {
        return $array[array_rand($array)];
    }
}
