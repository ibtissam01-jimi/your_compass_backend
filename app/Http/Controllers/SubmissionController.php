<?php

namespace App\Http\Controllers;

use App\Models\Service_Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubmissionController extends Controller
{
    public function index()
    {
        $submission = Service_Submission::all();
        return $submission;
    }

    
//     public function store(Request $request)
// {
//     // Validation des données avec la validation de l'image spécifiée


//     // Création de la soumission
//     $submission = new Service_Submission();

//     // Assigner les valeurs aux propriétés du modèle
//     $submission->name = $request->name;
//     $submission->description = $request->description;
//     $submission->address = $request->address;
//     $submission->website = $request->website;
//     $submission->email = $request->email;
//     $submission->phone_number = $request->phone_number;
//     $submission->category_id = $request->category_id;
//     $submission->city_id = $request->city_id;

//     // Gestion de l'image
//     if ($request->hasFile('image')) {
//         // Récupérer le nom original de l'image
//         $imageName = $request->file('image')->getClientOriginalName();

//         // Déplacer l'image vers le dossier public/images/services
//         $imagePath = public_path('/images/services');
//         $request->file('image')->move($imagePath, $imageName);

//         // Enregistrer le chemin relatif de l'image dans la base de données
//         $submission->image = '/images/services/' . $imageName;
//     }

//     // Enregistrer la soumission dans la base de données
//     $submission->status = 'pending';  // Vous pouvez définir un statut par défaut
//     $submission->save();

//     // Retourner une réponse JSON avec un message de succès
//     return response()->json(['message' => 'Soumission reçue avec succès'], 201);
// }




public function store(Request $request)
{
    // Validation des données (ajoutée ici pour la validation des entrées)

    // Création de la soumission
    $submission = new Service_Submission();

    // Assigner les valeurs aux propriétés du modèle
    $submission->name = $request->name;
    $submission->description = $request->description;
    $submission->address = $request->address;
    $submission->website = $request->website;
    $submission->email = $request->email;
    $submission->phone_number = $request->phone_number;
    $submission->category_id = $request->category_id;
    $submission->city_id = $request->city_id;

    // Gestion de l'image
    if ($request->hasFile('image')) {
        $imageName = $request->file('image')->getClientOriginalName();
        $imagePath = public_path('/images/services/');
        $request->file('image')->move($imagePath, $imageName);
        $submission->image = '/images/services/' . $imageName;
    } else {
        // You can either skip saving the image or provide a default value
        $submission->image = null;  // Set to null if no image is uploaded
    }
    
    // Enregistrer la soumission dans la base de données
    $submission->status = 'pending';
    $submission->user_id =1;  // Vous pouvez définir un statut par défaut
    $submission->save();

    // Retourner une réponse JSON avec un message de succès
    return response()->json(['message' => 'Soumission reçue avec succès'], 201);
}







public function destroy($id)
{
    $submission = Service_Submission::findOrFail($id);
    $submission->delete();

    return response()->json(['message' => 'Soumission supprimée avec succès.']);
}

}
