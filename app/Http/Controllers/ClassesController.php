<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\OfferedClass;

class ClassesController extends Controller
{
    public function show(){

        $classes = OfferedClass::get();

        return view('classes.index', compact('classes'));
    }

    public function addClass(Request $request, $id)
    {
        // Find the food item by ID
        $class = OfferedClass::find($id);

        // Get the currently authenticated user
        $user = Auth::user();

        // Associate the food item with the user through the link table
        $user->classes()->attach($class->id);

        // Redirect back to the nutrition page
        return redirect()->route('classes')->with('success', 'You have been registered for this class.');
    }

    public function showForm()
    {
        return view('classes.form');
    }

    public function processForm(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'required|text',
            'date' => 'required|date',
            'time' => 'time'
        ]);

        // Create a new Food instance
        $food = new Food([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'date' => $validatedData('date'),
            'time' => $validatedData('official_option')
        ]);

        // Save the food item to the database
        $food->save();

        return "Data stored successfully!";
    }
}
