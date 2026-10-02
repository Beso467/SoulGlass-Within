<?php

namespace Database\Seeders;

use App\Models\Mirror;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $io = Mirror::create([
            'slug' => 'io',
            'name' => 'IO',
            'title' => 'The Watcher',
            'type' => 'seasonal',
            'season' => 'fall',
            'accent_color' => '#FF7A1A',
        ]);

        $io->quotes()->createMany([
            ['text' => 'What you rush past was waiting for you.', 'is_active' => true],
            ['text' => 'Second sample quote.', 'is_active' => true, 'weight' => 5],
        ]);
    }
}
