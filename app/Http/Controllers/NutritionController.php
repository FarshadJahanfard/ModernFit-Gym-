<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Food;

class NutritionController extends Controller
{
    public function show()
    {
        $communityFoods = Food::where('official', false)->get();
        $officialFoods = Food::where('official', true)->get();
        $communityRunningTotal = $communityFoods->sum('calories');
        $officialRunningTotal = $officialFoods->sum('calories');

        return view('nutrition.show', compact('communityFoods', 'officialFoods', 'communityRunningTotal', 'officialRunningTotal'));
    }

    public function addFood(Request $request, $id)
{
    $food = Food::find($id);
    $user = Auth::user();

    $user->foods()->attach($food->id, ['created_at' => now()]);

    return redirect()->route('nutrition.show')->with('success', 'Food has been added to today\'s meals.');
}

    public function likeFood($id)
    {
        $food = Food::find($id);
        $user = Auth::user();

        if ($user->dislikedFoods->contains($food->id)) {
            $user->dislikedFoods()->detach($food->id);
            $food->dislikes -= 1;
        }

        if (!$user->likedFoods->contains($food->id)) {
            $user->likedFoods()->attach($food->id);
            $food->likes += 1;
        }

        $food->save();
        return redirect()->route('nutrition.show');
    }

    public function dislikeFood($id)
    {
        $food = Food::find($id);
        $user = Auth::user();

        if ($user->likedFoods->contains($food->id)) {
            $user->likedFoods()->detach($food->id);
            $food->likes -= 1;
        }

        if (!$user->dislikedFoods->contains($food->id)) {
            $user->dislikedFoods()->attach($food->id);
            $food->dislikes += 1;
        }

        $food->save();
        return redirect()->route('nutrition.show');
    }

    private function userHasLiked(Food $food)
    {
        return Auth::user()->likedFoods->contains($food->id);
    }

    private function userHasDisliked(Food $food)
    {
        return Auth::user()->dislikedFoods->contains($food->id);
    }
}
