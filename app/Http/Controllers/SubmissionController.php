<?php

namespace App\Http\Controllers;

use App\Models\Service_Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubmissionController extends Controller
{
    // Afficher toutes les soumissions
    public function index()
    {
        $submissions = Service_Submission::all();
        return response()->json($submissions);
    }

    // Ajouter une nouvelle soumission
    public function store(Request $request)
    {
        $user_id = Auth::id();

        $submission = new Service_Submission();
        $submission->name = $request->name;
        $submission->description = $request->description;
        $submission->status = 'pending';
        $submission->website = $request->website;
        $submission->address = $request->address;
        $submission->phone_number = $request->phone_number;
        $submission->email = $request->email;
        $submission->user_id = $user_id;
        $submission->city_id = $request->city_id;
        $submission->category_id = $request->category_id;
        $submission->save();

        return response()->json($submission, 201);
    }

    // Afficher une soumission pour l'édition
    public function edit($id)
    {
        $submission = Service_Submission::findOrFail($id);
        return response()->json($submission);
    }

    // Mettre à jour une soumission existante
    public function update(Request $request, $id)
    {
        $submission = Service_Submission::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'owner' => 'required|string|max:255',
            'date' => 'required|date',
            'status' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'website' => 'required|url|max:255',
        ]);

        $submission->update($data);
        return response()->json($submission);
    }

    // Supprimer une soumission
    public function destroy($id)
    {
        $submission = Service_Submission::findOrFail($id);
        $submission->delete();
        return response()->json(['message' => 'Soumission supprimée avec succès.']);
    }
}
