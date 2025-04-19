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



    
    public function getAllPlaces()
    {
        $services = Service::with([ 'category', 'admin'])
            ->where('category_id', 4)
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
//     public function store(Request $request)
// {
//     // Validation des données

//     $categoryId = $request->category_id ?? 1;
    
//     // Création d'un nouveau service
//     $service = new Service();
//     $service->name = $request->name;
//     $service->slug = $request->slug;
//     $service->description = $request->description;
//     $service->address = $request->address;
//     $service->website = $request->website;
//     $service->email = $request->email;
//     $service->phone_number = $request->phone_number;
//     $service->city_id = $request->city_id;


//     $service->category_id = $categoryId; 


//     // Gestion de l'image
//     if ($request->hasFile('image')) {
//         $path = $request->file('image')->store('services', 'public');
//         $service->image = $path;
//     }

//     // Enregistrement du service
//     $service->save();

//     // Retourner une réponse JSON avec un message de succès
//     return response()->json(['message' => 'Service ajouté avec succès'], 201);
// }






public function store(Request $request)
{


    // Récupérer l'ID de la catégorie ou définir la valeur par défaut
    $categoryId = $request->category_id ?? 1;

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
    $service->category_id = $categoryId; 

    // Gestion de l'image
    if ($request->hasFile('image')) {
        // Récupérer le nom de l'image et la stocker dans le dossier 'public/images/services'
        $imageName = $request->file('image')->getClientOriginalName();
        $path = $request->file('image')->storeAs('/images/services', $imageName, 'public');
        
        // Enregistrer le chemin relatif dans la base de données
        $service->image = '/images/services/' . $imageName;
    }

    // Enregistrement du service
    $service->save();

    // Retourner une réponse JSON avec un message de succès
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

        // return redirect()->route('services.index')->with('success', 'Service supprimé avec succès.');
        return response()->json(['message' => 'Deleted']);
    }
}
