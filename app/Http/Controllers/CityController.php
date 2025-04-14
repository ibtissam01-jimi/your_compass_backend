<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Service;
use App\Models\Tourist_Guide;

class CityController extends Controller
{
    /**
     * Affiche la liste des villes.
     */
    public function index()
    {
       
        
            return response()->json(City::select('name', 'image')->get());

    }

    /**
     * Affiche le formulaire de création d'une ville.
     */
    public function create()
    {
        return view('cities.create');
    }

    /**
     * Enregistre une nouvelle ville dans la base de données.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $city = new City();
        $city->name = $request->name;
        $city->description = $request->description;
        $city->location = $request->location;

        // Gérer l'upload de l'image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('cities', 'public');
            $city->image = $imagePath;
        }

        $city->save();
        return redirect()->route('cities.index')->with('success', 'Ville ajoutée avec succès.');
    }

    /**
     * Affiche une ville spécifique avec ses services et guides touristiques.
     */
    public function show(string $id)
    {
        $city = City::with(['services', 'touristGuides'])->findOrFail($id);
        return view('cities.show', ['city' => $city]);
    }

    /**
     * Affiche le formulaire d'édition d'une ville.
     */
    public function edit(string $id)
    {
        $city = City::findOrFail($id);
        return view('cities.edit', ['city' => $city]);
    }

    /**
     * Met à jour une ville existante dans la base de données.
     */
    public function update(Request $request, string $id)
    {
        $city = City::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $city->name = $request->name;
        $city->description = $request->description;
        $city->location = $request->location;

        // Gérer la mise à jour de l'image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('cities', 'public');
            $city->image = $imagePath;
        }

        $city->save();
        return redirect()->route('cities.index')->with('success', 'Ville mise à jour avec succès.');
    }

    /**
     * Supprime une ville et ses relations associées.
     */
    public function destroy(string $id)
    {
        $city = City::findOrFail($id);

        // Détacher les relations avant suppression
        $city->services()->delete();
        $city->touristGuides()->delete();

        $city->delete();
        return redirect()->route('cities.index')->with('success', 'Ville supprimée avec succès.');
    }
}
