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
                "https://static.fnac-static.com/multimedia/PE/Images/FR/NR/06/d2/ee/15651334/1507-1/tsp20240112122831/Chere-Mamie-tu-vas-rire.jpg",
                "https://static.fnac-static.com/multimedia/PE/Images/FR/NR/44/85/f6/16155972/1507-1/tsp20240113074403/Ceci-n-est-pas-un-fait-divers.jpg",
                "https://static.fnac-static.com/multimedia/Images/FR/NR/72/86/fe/16680562/1507-1/tsp20240117080336/L-insolente-de-Stannage-Park.jpg",
                "https://static.fnac-static.com/multimedia/PE/Images/FR/NR/57/20/f7/16195671/1507-1/tsp20240118071559/Tainted-Hearts-tome-3.jpg",
                "https://static.fnac-static.com/multimedia/Images/FR/NR/64/3c/ff/16727140/1507-1/tsp20240120080505/Un-pays-de-neige-et-de-cendres.jpg",
                "https://static.fnac-static.com/multimedia/Images/FR/NR/9b/c6/ae/11454107/1507-1/tsp20230720145306/Tout-le-bleu-du-ciel.jpg",
                "https://static.fnac-static.com/multimedia/PE/Images/FR/NR/cb/b3/ac/11318219/1507-1/tsp20240118104422/Kilometre-zero.jpg",
                "https://static.fnac-static.com/multimedia/PE/Images/FR/NR/ba/e1/93/9691578/1507-1/tsp20231222112740/La-tree.jpg",
                "https://static.fnac-static.com/multimedia/Images/FR/NR/63/9e/db/14392931/1507-1/tsp20230906080804/Tant-que-le-cafe-est-encore-chaud.jpg",
                "https://static.fnac-static.com/multimedia/PE/Images/FR/NR/11/9b/1d/1940241/1507-1/tsp20240104092506/L-Alchimiste.jpg",
            ]),
            "price" => fake()->numberBetween(100, 10000),
            "editor_id" => Editor::all()->random()->id
        ];
    }
}
