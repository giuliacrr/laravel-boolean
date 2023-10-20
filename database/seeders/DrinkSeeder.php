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
    $idDrinks = [];

    for ($i = 0; $i < 20; $i++) {

      $response = Http::get('https://www.thecocktaildb.com/api/json/v1/1/random.php');
      $drinks = $response->json();

      foreach ($drinks as $element) {
        $drink = $element[0];

        if (!in_array($drink["idDrink"], $idDrinks)) {

          $idDrinks[] = $drink["idDrink"];

          $newDrink = new Drink();

          $newDrink->drink_name = $drink["strDrink"];
          $newDrink->category = $drink["strCategory"];
          $newDrink->alcoholic = $drink["strAlcoholic"];
          $newDrink->thumbnail = $drink["strDrinkThumb"];

          $ingredients = [];
          $j = 1;

          do {

            $key = "strIngredient" . $j;
            $ingredient = $drink[$key] ?? null;

            if ($ingredient) {
              $ingredients[] = $ingredient;
            }

            $j++;
          } while ($ingredient != null);

          $newDrink->ingredients = json_encode($ingredients);

          $newDrink->price = $faker->randomFloat(2, 5, 20);
          $newDrink->save();
        }
        else{
          $i--;
        }
      }
    }
  }

}
