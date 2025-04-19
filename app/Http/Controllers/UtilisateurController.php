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
        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->nationality = $request->nationality;
        $user->birth_date = $request->birth_date;
        $user->save();

        return response()->json(['message' => 'User created successfully', 'user' => $user], 201);
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
    public function destroy($id)
    {
        $evaluator = User::findOrFail($id);
        $evaluator->delete();
    
        return response()->json(['message' => 'Deleted']);
    }
}
