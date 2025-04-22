<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller

{
    public function index($user_id)
{
    $favorites = Favorite::with('service') // relation avec Service
        ->where('user_id', $user_id)
        ->get();

    return response()->json($favorites);
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'utilisateur_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
        ]);

        $exists = Favorite::where('utilisateur_id', $validated['utilisateur_id'])
            ->where('service_id', $validated['service_id'])
            ->exists();

        if ($exists) {
            return response()->json(['message' => 'Déjà dans les favoris'], 409);
        }

        Favorite::create($validated);

        return response()->json(['message' => 'Ajouté aux favoris !']);
}

}