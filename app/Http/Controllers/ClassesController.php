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
}
