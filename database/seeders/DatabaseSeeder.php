<?php

namespace Database\Seeders;

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

        \App\Models\User::factory()->create(['email' => 'i@admin.com']);
        \App\Models\User::factory(29)->create();

        \App\Models\Category::factory(12)->create();
        \App\Models\Recipe::factory(100)->create();
        \App\Models\Tag::factory(40)->create();

        $recipes = \App\Models\Recipe::all();
        $tags = \App\Models\Tag::all();

        foreach ($recipes as $recipe) {
            $recipe->tags()->attach($tags->random(rand(2,4)));
        }
    }
}
