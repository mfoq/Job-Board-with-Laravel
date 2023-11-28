<?php

namespace App\Http\Controllers;

use App\Models\Job;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Job::class);
        $filters = request()->only('search', 'min_salary', 'max_salary', 'experience', 'category');
        return view('job.index', ['jobs' => Job::with('employer')->latest()->filter($filters)->get()]);
    }


    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {

        return view('job.sohw', ['job' => $job->load('employer.jobs', 'employer.user')]);
    }

}

