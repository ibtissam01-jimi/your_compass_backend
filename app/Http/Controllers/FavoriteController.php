<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Utilisateur;
use App\Models\Service;

class FavoriteController extends Controller
{
    /**
     * Affiche la liste des favoris.
     */
    public function index()
    {
        $favorites = Favorite::with(['utilisateur', 'service'])->get();
        return view('favorites.index', ['favorites' => $favorites]);
    }

    /**
     * Affiche le formulaire pour ajouter un favori.
     */
    public function create()
    {
        $users = Utilisateur::all();
        $services = Service::all();

        return view('favorites.create', [
            'users' => $users,
            'services' => $services
        ]);
    }

    /**
     * Ajoute un favori.
     */
    public function store(Request $request)
    {
        $request->validate([
            'utilisateur_id' => 'required|exists:utilisateurs,id',
            'service_id' => 'required|exists:services,id',
        ]);

        // Vérifier si le favori existe déjà
        $existingFavorite = Favorite::where('utilisateur_id', $request->utilisateur_id)
                                    ->where('service_id', $request->service_id)
                                    ->first();

        if ($existingFavorite) {
            return redirect()->route('favorites.index')->with('error', 'Ce service est déjà dans vos favoris.');
        }

        Favorite::create([
            'utilisateur_id' => $request->utilisateur_id,
            'service_id' => $request->service_id,
        ]);

        return redirect()->route('favorites.index')->with('success', 'Favori ajouté avec succès.');
    }

    /**
     * Affiche un favori spécifique.
     */
    public function show(string $id)
    {
        $favorite = Favorite::with(['utilisateur', 'service'])->findOrFail($id);
        return view('favorites.show', ['favorite' => $favorite]);
    }

    /**
     * Supprime un favori.
     */
    public function destroy(string $id)
    {
        $favorite = Favorite::findOrFail($id);
        $favorite->delete();

        return redirect()->route('favorites.index')->with('success', 'Favori supprimé avec succès.');
    }
}
