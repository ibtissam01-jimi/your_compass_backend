<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Utilisateur;
use App\Models\Service;
use App\Models\Tourist_Guide;

class CommentController extends Controller
{
    /**
     * Affiche la liste des commentaires.
     */
    public function index()
    {
        $comments = Comment::with(['user', 'service', 'guide'])->get();
        return $comments;
    }

    /**
     * Affiche le formulaire pour créer un commentaire.
     */
    public function create()
    {
        $users = Utilisateur::all();
        $services = Service::all();
        $guides = Tourist_Guide::all();

        return view('comments.create', [
            'users' => $users,
            'services' => $services,
            'guides' => $guides
        ]);
    }

    /**
     * Stocke un nouveau commentaire dans la base de données.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'status' => 'required|in:approved,pending,rejected',
            'utilisateur_id' => 'required|exists:utilisateurs,id',
            'service_id' => 'nullable|exists:services,id',
            'guide_id' => 'nullable|exists:tourist__guides,id',
        ]);

        Comment::create([
            'content' => $request->content,
            'publication_date' => now(),
            'status' => $request->status,
            'utilisateur_id' => $request->utilisateur_id,
            'service_id' => $request->service_id,
            'guide_id' => $request->guide_id,
        ]);

        return redirect()->route('comments.index')->with('success', 'Commentaire ajouté avec succès.');
    }

    /**
     * Affiche les détails d'un commentaire spécifique.
     */
    public function show(string $id)
    {
        $comment = Comment::with(['user', 'service', 'guide'])->findOrFail($id);
        return view('comments.show', ['comment' => $comment]);
    }

    /**
     * Supprime un commentaire.
     */
    public function destroy(string $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect()->route('comments.index')->with('success', 'Commentaire supprimé avec succès.');
    }
}
