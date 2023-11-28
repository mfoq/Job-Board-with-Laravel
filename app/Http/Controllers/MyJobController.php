<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Models\Job;

class MyJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $this->authorize('viewAnyEmployer', Job::class);
        return view(
            "my_job.index",
            ["jobs" => auth()->user()->employer->jobs()
                    ->with(['employer', 'jobApplications', 'jobApplications.user'])
                    ->withTrashed()
                    ->get(),
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Job::class);
        return view("my_job.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobRequest $request)
    {

        $this->authorize('create', Job::class);
        auth()->user()->employer->jobs()->create($request->validated);

        return redirect()->route('my-jobs.index')
            ->with('success', 'The Job Offer Has Been Added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $my_job)
    {

        $this->authorize('update', $my_job);
        return view("my_job.edit", ['job' => $my_job]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobRequest $request, Job $my_job)
    {

        $this->authorize('update', $my_job);
        $my_job->update($request->validated());

        return redirect()->route('my-jobs.index')
            ->with('success', 'Job Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $my_job)
    {
        $my_job->delete();

        return redirect()->route('my-jobs.index')
            ->with('success', 'Job Deleted permenantly!');
    }
}
