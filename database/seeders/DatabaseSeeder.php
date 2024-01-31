<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Ali Elhamied',
            'username' => 'alyakbar',
            'email' => 'alielhamied1@gmail.com',
            'password' => bcrypt('password'),
        ]);

        User::factory(2)->create();

        Post::factory(20)->create();
        
        Category::create([
            'name' => 'Personal',
            'slug' => 'personal',
        ]);
        
        Category::create([
            'name' => 'Programming',
            'slug' => 'programming',
        ]);
        
        Category::create([
            'name' => 'Hobbies',
            'slug' => 'hobbies',
        ]);

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
