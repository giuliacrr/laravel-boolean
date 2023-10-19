<?php

namespace Database\Seeders;

use App\Models\Drink;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Faker\Generator as Faker;


class DrinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $drinks = [];

        for ($i=11000; $i < 11020 ; $i++) { 
            
            $response = Http::get("www.thecocktaildb.com/api/json/v1/1/lookup.php?i=" . $i);
            $drinks = $response->json();

            foreach ($drinks as $drink) {
                $newDrink = new Drink();
    
                $newDrink->drink_name = $drink[0]["strDrink"] ?? "null";
                $newDrink->category = $drink[0]["strCategory"] ?? "null";
                $newDrink->alcoholic = $drink[0]["strAlcoholic"] ?? "null";
                $newDrink->thumbnail = $drink[0]["strDrinkThumb"] ?? "null";

                $ingredients = [
                    $drink[0]["strIngredient1"] ?? "null",
                    $drink[0]["strIngredient2"] ?? "null",
                    $drink[0]["strIngredient3"] ?? "null",
                    $drink[0]["strIngredient4"] ?? "null",
                    $drink[0]["strIngredient5"] ?? "null",
                    $drink[0]["strIngredient6"] ?? "null",
                    $drink[0]["strIngredient7"] ?? "null",
                    $drink[0]["strIngredient8"] ?? "null",
                    $drink[0]["strIngredient9"] ?? "null",
                    $drink[0]["strIngredient10"] ?? "null",
                    $drink[0]["strIngredient11"] ?? "null",
                    $drink[0]["strIngredient12"] ?? "null",
                    $drink[0]["strIngredient13"] ?? "null",
                    $drink[0]["strIngredient14"] ?? "null",
                    $drink[0]["strIngredient15"] ?? "null",
                ];
                $newDrink->ingredients = json_encode($ingredients);

                $newDrink->price = $faker->randomFloat(2, 5, 20);
    
                $newDrink->save();
            }
        }
    }
}
