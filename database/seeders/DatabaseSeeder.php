<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'user_name' => 'testtest',
            'first_name' => 'Test',
            'sur_name' => 'bot',
            'email' => 'test@example.com',
            'password'
        ]);
    }
}
