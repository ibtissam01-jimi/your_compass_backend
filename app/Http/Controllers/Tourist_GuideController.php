<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tourist_Guide;
use App\Models\City;

class TouristGuideController extends Controller
{
    /**
     * Affiche la liste des guides touristiques.
     */
    public function index()
    {
        $guides = Tourist_Guide::with('city')->get();
        return view('guides.index', ['guides' => $guides]);
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
        $request->validate([
            'name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'cin' => 'required|string|max:20|unique:tourist__guides,cin',
            'address' => 'nullable|string|max:255',
            'email' => 'required|email|unique:tourist__guides,email',
            'phone_number' => 'required|string|max:15',
            'cv' => 'nullable|string',
            'photo' => 'nullable|string',
            'city_id' => 'required|exists:cities,id',
        ]);

        Tourist_Guide::create($request->all());

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

        $request->validate([
            'name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'cin' => 'required|string|max:20|unique:tourist__guides,cin,' . $id,
            'address' => 'nullable|string|max:255',
            'email' => 'required|email|unique:tourist__guides,email,' . $id,
            'phone_number' => 'required|string|max:15',
            'cv' => 'nullable|string',
            'photo' => 'nullable|string',
            'city_id' => 'required|exists:cities,id',
        ]);

        $guide->update($request->all());

        return redirect()->route('guides.index')->with('success', 'Guide mis à jour avec succès.');
    }

    /**
     * Supprime un guide touristique.
     */
    public function destroy(string $id)
    {
        $guide = Tourist_Guide::findOrFail($id);
        $guide->delete();

        return redirect()->route('guides.index')->with('success', 'Guide supprimé avec succès.');
    }
}
