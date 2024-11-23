<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Booking;
use App\Models\User;
use App\Models\Service;
use App\Models\ServiceProvider;
use Carbon\Carbon;

class BookingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::pluck('id')->toArray();
        $serviceIds = Service::pluck('id')->toArray();
        $serviceProviderIds = ServiceProvider::pluck('id')->toArray();
        $cityIds = DB::table('cities')->pluck('id')->toArray(); // Fetch city IDs from the cities table

        foreach (range(1, 20) as $index) {
            Booking::create([
                'user_id' => $this->getRandomElement($userIds),
                'service_id' => $this->getRandomElement($serviceIds),
                'service_provider_id' => $this->getRandomElement($serviceProviderIds),
                'city_id' => $this->getRandomElement($cityIds),
                'booking_date' => Carbon::now()->addDays(rand(1, 30))->addHours(rand(1, 24)),
                'total_price' => rand(50, 500) + rand(0, 99) / 100,
                'status' => ['pending', 'confirmed', 'completed', 'cancelled'][array_rand(['pending', 'confirmed', 'completed', 'cancelled'])],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Helper to get a random element from an array.
     */
    private function getRandomElement(array $array)
    {
        return $array[array_rand($array)];
    }
}
