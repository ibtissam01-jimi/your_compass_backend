<?php

namespace App\Http\Controllers;

use App\Models\Service_Submission;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function index()
    {
        $submission = Service_Submission::all();
        return $submission;
    }

    
    public function store(Request $request){
        // $request->validate([
        //     'name' => 'string|required|min:4',
        //     'slug' => 'string|required|min:4',
        //     'description' => 'string|required|min:30',
        //     'website' => 'string|required',
        //     'location' => 'string|required|min:10',
        //     'status' => 'required|in:approved,pending,rejected',
        //     'email' => 'required|email',
        //     'phone_number' => 'string|required|min:10',

        // ]);

        $submission = new Service_Submission();
        $submission->name = $request->name;
        $submission->description = $request->description;
        $submission->slug = $request->slug;
        $submission->status = $request->status;
        $submission->website = $request->website;
        $submission->address = $request->address;
        $submission->phone_number = $request->phone_number;
        $submission->email = $request->email;
        $submission->user_id = $request->user_id;
        $submission->city_id = $request->city_id;
        $submission->category_id = $request->category_id;
        $submission->save();

    }




    public function destroy(string $id)
    {
        $service = Service_Submission::findOrFail($id);
        $service->delete();

        // return redirect()->route('services.index')->with('success', 'Service supprimé avec succès.');
        return response()->json(['message' => 'Deleted']);
    }
}
