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
    
                $newDrink->drink_name = $drink["strDrink"];
                $newDrink->category = $drink["strCategory"];
                $newDrink->alcoholic = $drink["strAlcoholic"];
                $newDrink->thumbnail = $drink["strDrinkThumb"];

                $ingredients = [
                    $drink["strIngredient1"],
                    $drink["strIngredient2"],
                    $drink["strIngredient3"],
                    $drink["strIngredient4"],
                    $drink["strIngredient5"],
                    $drink["strIngredient6"],
                    $drink["strIngredient7"],
                    $drink["strIngredient8"],
                    $drink["strIngredient9"],
                    $drink["strIngredient10"],
                    $drink["strIngredient11"],
                    $drink["strIngredient12"],
                    $drink["strIngredient13"],
                    $drink["strIngredient14"],
                    $drink["strIngredient15"],
                ];
                $newDrink->ingredients = json_encode($ingredients);

                $newDrink->price = $faker->randomFloat(2, 5, 20);
    
                $newDrink->save();
            }
        }
    }
}
