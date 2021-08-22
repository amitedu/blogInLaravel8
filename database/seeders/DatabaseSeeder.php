<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * @return void
     */
    public function run(): void
    {
        Post::factory()->create();

        $user = User::factory()->create([
            'username' => 'jhonDoe',
            'name' => 'Jhon Doe'
        ]);

        Post::factory()->create([
            'user_id' => $user->id
        ]);
    }
}
