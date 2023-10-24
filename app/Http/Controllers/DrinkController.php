<?php

namespace App\Http\Controllers;

use App\Models\Drink;
use Illuminate\Http\Request;

class DrinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $queryString = request()->query();

        if (array_key_exists('alcolFilter', $queryString) && $queryString['alcolFilter'] != 'All') {
            $drinks = Drink::where('alcoholic', $queryString['alcolFilter'])->get();
        } else {
            $drinks = Drink::all();
        }

        return response()->json($drinks);
    }
}
