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
        return response()->json(Service::all());
    }

    /**
     * Récupère tous les lieux de services dans une catégorie spécifique.
     */
    public function getAllPlaces()
    {
        $services = Service::with(['category', 'admin'])
            ->where('category_id', 4) // Exemple: Afficher les services dans la catégorie 4
            ->get();

        return response()->json($services);
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
        // Validation des données
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:services,slug',
            'description' => 'nullable|string',
            'address' => 'required|string',
            'website' => 'nullable|url',
            'email' => 'required|email',
            'phone_number' => 'required|string',
            'city_id' => 'required|exists:cities,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Création d'un nouveau service
        $service = new Service();
        $service->name = $request->name;
        $service->slug = $request->slug;
        $service->description = $request->description;
        $service->address = $request->address;
        $service->website = $request->website;
        $service->email = $request->email;
        $service->phone_number = $request->phone_number;
        $service->city_id = $request->city_id;
        $service->category_id = $request->category_id;

        // Gestion de l'image (si elle est présente)
        if ($request->hasFile('image')) {
            $imageName = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('/images/services', $imageName, 'public');
            $service->image = '/images/services/' . $imageName;
        }

        // Enregistrement du service
        $service->save();

        return response()->json(['message' => 'Service ajouté avec succès'], 201);
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

        // Validation des données
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:services,slug,' . $service->id,
            'description' => 'nullable|string',
            'address' => 'required|string',
            'website' => 'nullable|url',
            'email' => 'required|email',
            'phone_number' => 'required|string',
            'city_id' => 'required|exists:cities,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Mise à jour du service
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

        return response()->json(['message' => 'Service supprimé avec succès.']);
    }
}
