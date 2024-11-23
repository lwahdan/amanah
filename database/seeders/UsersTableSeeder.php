<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Provider Users
        User::create([
            'name' => 'Provider1',
            'email' => 'provider1@gmail.com',
            'password' => Hash::make('provider1111'),
            'role' => 'provider',
            'phone' => '1234567891',
        ]);

        User::create([
            'name' => 'Provider2',
            'email' => 'provider2@gmail.com',
            'password' => Hash::make('provider2222'),
            'role' => 'provider',
            'phone' => '1234567892',
        ]);

        // Client Users
        User::create([
            'name' => 'Client1',
            'email' => 'client1@gmail.com',
            'password' => Hash::make('client1111'),
            'role' => 'client',
            'phone' => '1234567893',
        ]);

        User::create([
            'name' => 'Client2',
            'email' => 'client2@gmail.com',
            'password' => Hash::make('client2222'),
            'role' => 'client',
            'phone' => '1234567894',
        ]);
    }
}
