<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{

    public function create(Job $job)
    {
        $this->authorize('apply', $job);
        return view('job_application.create', ['job' => $job]);
    }

    public function store(Job $job, Request $request)
    {
        $this->authorize('apply', $job);

        $validatedDate = $request->validate([
            'expected_salary' => 'required|min:1|max:10000',
            'cv' => 'required|file|mimes:pdf|max:2048',
        ]);


        $file = $request->file('cv'); //field name
        $path = $file->store('cvs', 'private');

        $job->jobApplications()->create([
            'user_id' => auth()->user()->id,
            'expected_salary' => $validatedDate['expected_salary'],
            'cv_path' => $path,
        ]);

        return redirect()->route('jobs.show', $job)->with('success', "You applied fpr job successfully!");

    }

    public function destroy(string $id)
    {
        //
    }
}
