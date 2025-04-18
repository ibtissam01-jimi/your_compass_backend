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

    
    public function store(Request $request){
        $user_id=Auth::id();

        $submission = new Service_Submission();
        $submission->name = $request->name;
        $submission->description = $request->description;
        //$submission->slug = $request->slug;
        $submission->status = 'pending';
        $submission->website = $request->website;
        $submission->address = $request->address;
        $submission->phone_number = $request->phone_number;
        $submission->email = $request->email;
        $submission->user_id = $user_id;
        $submission->city_id = $request->city_id;
        $submission->category_id = $request->category_id;
        $submission->save();

    }
}
