<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tourist_Guide;
use App\Models\City;

class Tourist_GuideController extends Controller
{
    /**
     * Affiche la liste des guides touristiques.
     */
    public function index()
    {
        $guides = Tourist_Guide::all();
        return response()->json(['guides' => $guides]);
    }

    /**
     * Affiche le formulaire de création d'un guide touristique.
     */
    public function create()
    {
        $cities = City::all();
        return view('guides.create', ['cities' => $cities]);
    }

    /**
     * Enregistre un nouveau guide touristique.
     */
    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'cin' => 'required|string|max:20|unique:tourist_guides,cin',
            'address' => 'nullable|string|max:255',
            'email' => 'required|email|unique:tourist_guides,email',
            'phone_number' => 'required|string|max:15',
            'cv' => 'nullable|mimes:pdf|max:2048',
            'photo' => 'nullable|image|max:2048',
            'city_id' => 'required|exists:cities,id',
        ]);

        // Création du guide avec les données validées
        $guideData = $validated;

        // Gestion des fichiers (photo et CV)
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
            $guideData['photo'] = $photoPath;
        }

        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cvs', 'public');
            $guideData['cv'] = $cvPath;
        }

        // Création du guide dans la base de données
        Tourist_Guide::create($guideData);

        return redirect()->route('guides.index')->with('success', 'Guide ajouté avec succès.');
    }

    /**
     * Affiche un guide spécifique.
     */
    public function show(string $id)
    {
        $guide = Tourist_Guide::with('city')->findOrFail($id);
        return view('guides.show', ['guide' => $guide]);
    }

    /**
     * Affiche le formulaire d'édition d'un guide touristique.
     */
    public function edit(string $id)
    {
        $guide = Tourist_Guide::findOrFail($id);
        $cities = City::all();

        return view('guides.edit', ['guide' => $guide, 'cities' => $cities]);
    }

    /**
     * Met à jour un guide touristique.
     */
    public function update(Request $request, string $id)
    {
        $guide = Tourist_Guide::findOrFail($id);

        // Validation des données pour la mise à jour
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'cin' => 'required|string|max:20|unique:tourist_guides,cin,' . $id,
            'email' => 'required|email|unique:tourist_guides,email,' . $id,
            'address' => 'nullable|string|max:255',
            'phone_number' => 'required|string|max:15',
            'city_id' => 'required|exists:cities,id',
            'photo' => 'nullable|image|max:2048',
            'cv' => 'nullable|mimes:pdf|max:2048',
        ]);

        // Mise à jour de l'image si présente
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
            $validated['photo'] = $photoPath;
        }

        // Mise à jour du CV si présent
        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cvs', 'public');
            $validated['cv'] = $cvPath;
        }

        // Mise à jour des informations du guide
        $guide->update($validated);

        return response()->json(['message' => 'Guide mis à jour avec succès.', 'guide' => $guide]);
    }

    /**
     * Supprime un guide touristique.
     */
    public function destroy(string $id)
    {
        $guide = Tourist_Guide::findOrFail($id);
        $guide->delete();
    
        return response()->json(['message' => 'Guide supprimé avec succès.']);
    }
}
