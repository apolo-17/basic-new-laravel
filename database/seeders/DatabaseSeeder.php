<?php

namespace Database\Seeders;

use App\Models\Post;
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
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'name' => 'Apolinar Morales',
            'email' => 'apolinar.morales.a@gmail.com',
            'password' => bcrypt('facil123')
        ]);

        Post::factory()->count(24)->create();
    }
}
