<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('services')->insert([
            ['category_id' => 1, 'name' => 'Babysitting', 'description' => 'Childcare services for infants and toddlers.', 'price' => 50.00],
            ['category_id' => 1, 'name' => 'Nursing', 'description' => 'Professional nursing care for the sick or elderly.', 'price' => 100.00],
            ['category_id' => 1, 'name' => 'Eldercare', 'description' => 'Support services for elderly individuals.', 'price' => 80.00],
        ]);
    }
}
