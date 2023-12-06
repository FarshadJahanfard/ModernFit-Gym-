<?php
namespace App\Http\Controllers;

use App\Food\BasicFood;
use App\Food\VegetarianOption;
use Illuminate\Http\Request;

class ExampleController extends Controller
{
    public function index()
    {
        $basicFood = new BasicFood('Pizza', 1, 800, 'Delicious pizza with cheese and pepperoni');
        $vegetarianPizza = new VegetarianOption($basicFood);

        return view('example', compact('basicFood', 'vegetarianPizza'));
    }
}