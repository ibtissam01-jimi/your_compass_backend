<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\City;
use App\Models\Categorie;
use App\Models\Admin;

class ServiceController extends Controller
{
    /**
     * Affiche la liste des services.
     */
    public function index()
    {
        $services = Service::with(['city', 'category', 'admin'])->get();
        return $services;
    }

    /**
     * Affiche le formulaire de création d'un service.
     */
    public function create()
    {
        $cities = City::all();
        $categories = Categorie::all();
        $admins = Admin::all();

        return view('services.create', [
            'cities' => $cities,
            'categories' => $categories,
            'admins' => $admins
        ]);
    }

    /**
     * Enregistre un nouveau service.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string',
            'added_date' => 'required|date',
            'website_link' => 'nullable|url',
            'city_id' => 'required|exists:cities,id',
            'category_id' => 'required|exists:categories,id',
            'admin_id' => 'required|exists:admins,id',
        ]);

        Service::create($request->all());

        return redirect()->route('services.index')->with('success', 'Service ajouté avec succès.');
    }

    /**
     * Affiche un service spécifique.
     */
    public function show(string $id)
    {
        $service = Service::with(['city', 'category', 'admin'])->findOrFail($id);
        return view('services.show', ['service' => $service]);
    }

    /**
     * Affiche le formulaire d'édition d'un service.
     */
    public function edit(string $id)
    {
        $service = Service::findOrFail($id);
        $cities = City::all();
        $categories = Categorie::all();
        $admins = Admin::all();

        return view('services.edit', [
            'service' => $service,
            'cities' => $cities,
            'categories' => $categories,
            'admins' => $admins
        ]);
    }

    /**
     * Met à jour un service.
     */
    public function update(Request $request, string $id)
    {
        $service = Service::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string',
            'added_date' => 'required|date',
            'website_link' => 'nullable|url',
            'city_id' => 'required|exists:cities,id',
            'category_id' => 'required|exists:categories,id',
            'admin_id' => 'required|exists:admins,id',
        ]);

        $service->update($request->all());

        return redirect()->route('services.index')->with('success', 'Service mis à jour avec succès.');
    }

    /**
     * Supprime un service.
     */
    public function destroy(string $id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('services.index')->with('success', 'Service supprimé avec succès.');
    }
}
