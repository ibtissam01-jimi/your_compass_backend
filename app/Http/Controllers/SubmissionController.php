<?php

namespace App\Http\Controllers;

use App\Models\Service_Submission;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function index(){

    }
    public function store(Request $request){
        $request->validate([
            'name' => 'string|required|min:4',
            'slug' => 'string|required|min:4',
            'description' => 'string|required|min:30',
            'website' => 'string|regex:^www\.[a-zA-Z0-9-]+\.(com)$',
            'location' => 'string|required|min:10',
            'status' => 'required|in:approved,pending,rejected',
            'email' => 'required|email',
            'phone_number' => 'string|required|min:10',

        ]);

        $submission = new Service_Submission();
        $submission->name = $request->name;
        $submission->description = $request->description;
        $submission->slug = $request->slug;
        $submission->status = $request->status;
        $submission->website = $request->website;
        $submission->location = $request->location;
        $submission->user_id = $request->user_id;
        $submission->city_id = $request->city_id;
        $submission->category_id = $request->category_id;

    }
}
