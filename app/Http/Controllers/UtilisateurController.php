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
        return  $utilisateurs;
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
        $request->validate([
            'nationality' => 'required|string|max:255',
            'registration_date' => 'required|date',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:utilisateurs,email',
            'password' => 'required|string|min:6',
            'birth_date' => 'nullable|date',
        ]);

        Utilisateur::create([
            'nationality' => $request->nationality,
            'registration_date' => $request->registration_date,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'birth_date' => $request->birth_date,
        ]);

        return redirect()->route('utilisateurs.index')->with('success', 'Utilisateur ajouté avec succès.');
    }

    /**
     * Affiche les détails d'un utilisateur.
     */
    public function show(string $id)
    {
        $utilisateur = Utilisateur::findOrFail($id);
        return view('utilisateurs.show', ['utilisateur' => $utilisateur]);
    }

    /**
     * Affiche le formulaire de modification d'un utilisateur.
     */
    public function edit(string $id)
    {
        $utilisateur = Utilisateur::findOrFail($id);
        return view('utilisateurs.edit', ['utilisateur' => $utilisateur]);
    }

    /**
     * Met à jour un utilisateur.
     */
    public function update(Request $request, string $id)
    {
        $utilisateur = Utilisateur::findOrFail($id);

        $request->validate([
            'nationality' => 'required|string|max:255',
            'registration_date' => 'required|date',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:utilisateurs,email,' . $id,
            'password' => 'nullable|string|min:6',
            'birth_date' => 'nullable|date',
        ]);

        $utilisateur->update([
            'nationality' => $request->nationality,
            'registration_date' => $request->registration_date,
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $utilisateur->password,
            'birth_date' => $request->birth_date,
        ]);

        return redirect()->route('utilisateurs.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    /**
     * Supprime un utilisateur.
     */
    public function destroy(string $id)
    {
        $utilisateur = Utilisateur::findOrFail($id);
        $utilisateur->delete();

        return redirect()->route('utilisateurs.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
