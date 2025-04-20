<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UtilisateurController extends Controller
{
    /**
     * Affiche la liste des utilisateurs.
     */
    public function index()
    {
        $utilisateurs = User::all();
        return response()->json($utilisateurs); // Retourner les utilisateurs en format JSON
    }

    /**
     * Affiche le formulaire de création d'un utilisateur.
     */
    public function create()
    {
        return view('utilisateurs.create');
    }

    /**
     * Enregistre un nouvel utilisateur.
     */
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|string',
            'nationality' => 'required|string',
            'birth_date' => 'nullable|date',
        ]);

        // Création de l'utilisateur
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'nationality' => $request->nationality,
            'birth_date' => $request->birth_date,
        ]);

        // Retourner une réponse JSON avec un message de succès
        return response()->json(['message' => 'Utilisateur créé avec succès', 'user' => $user], 201);
    }

    /**
     * Affiche les détails d'un utilisateur.
     */
    public function show(string $id)
    {
        $utilisateur = User::findOrFail($id);
        return view('utilisateurs.show', ['utilisateur' => $utilisateur]);
    }

    /**
     * Affiche le formulaire de modification d'un utilisateur.
     */
    public function edit(string $id)
    {
        $utilisateur = User::findOrFail($id);
        return view('utilisateurs.edit', ['utilisateur' => $utilisateur]);
    }

    /**
     * Met à jour un utilisateur.
     */
    public function update(Request $request, $id)
    {
        // Valider les données
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
            'role' => 'required|string',
            'nationality' => 'required|string',
            'birth_date' => 'nullable|date',
        ]);

        // Trouver l'utilisateur
        $utilisateur = User::findOrFail($id);

        // Mettre à jour l'utilisateur
        $utilisateur->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $utilisateur->password,
            'role' => $request->role,
            'nationality' => $request->nationality,
            'birth_date' => $request->birth_date,
        ]);

        // Retourner une réponse JSON avec l'utilisateur mis à jour
        return response()->json(['message' => 'Utilisateur mis à jour avec succès', 'user' => $utilisateur], 200);
    }

    /**
     * Supprime un utilisateur.
     */
    public function destroy($id)
    {
        $utilisateur = User::findOrFail($id);
        $utilisateur->delete();

        // Retourner une réponse JSON avec un message de suppression
        return response()->json(['message' => 'Utilisateur supprimé avec succès']);
    }
}
