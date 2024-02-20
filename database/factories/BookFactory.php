<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Editor;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "title" => fake()->words(4, true),
            "resume" => fake()->text(1000),
            "published_at" => fake()->dateTimeBetween("-10 years"),
            /*"cover" => fake()->imageUrl(640, 480, "book", true),*/
            "cover" => fake()->randomElement([
                "5AnUbd2hpU620f2emqLPECjdzqNH9eFyy95egmUj.jpg",
                "PQ6Qk2hQLyAFB7s2SbMbV2uMEP0fxTKydd0RAHeo.jpg"
            ]),
            "price" => fake()->numberBetween(100, 10000),
            "editor_id" => Editor::all()->random()->id
        ];
    }
}
