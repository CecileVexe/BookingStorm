<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();
        \App\Models\Editor::factory(15)->create();
        //\App\Models\Book::factory(500)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\Category::factory()->create([
            "name" => "BD",
            "description" => "Une histoire en image",
            "slug" => "bd",
            "color" => "red",
        ]);

        \App\Models\Category::factory()->create([
            "name" => "Science Fiction",
            "description" => "Une histoire dans le future",
            "slug" => "science-fiction",
            "color" => "purple",
        ]);


        \App\Models\Category::factory()->create([
            "name" => "Policier",
            "description" => "Une histoire de meurtre",
            "slug" => "policier",
            "color" => "blue",
        ]);

        $books = \App\Models\Book::factory(100)->create();

        $categories = \App\Models\Category::all();
        // Foreach sur le tableau books
        // Pour chaque book on va venir lui attacher 1 ou 2 catégories attach() via belongsToMany
        // attach() attend en paramètre un tableau d'id
        // pluck() récupère QUE les ids de categories
        // toArray pour transormer la collection en tableau
        $books->each(function ($book) use ($categories) {
            $book->categories()->attach(
                $categories->random(rand(1, 2))->pluck("id")->toArray()
            );
        });
    }
}
