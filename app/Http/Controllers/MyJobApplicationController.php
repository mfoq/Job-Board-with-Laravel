<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;

class MyJobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view(
            'my_job_application.index',
            [
                'applications' => auth()->user()->jobApplications()
                    ->with(
                        ['job' => fn($query) => $query->withCount('jobApplications')
                                ->withAvg('jobApplications', 'expected_salary')
                                ->withTrashed(),
                            'job.employer',
                        ])
                    ->latest()->get(),
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobApplication $my_job_application)
    {
        $my_job_application->delete();

        return back()->with('success','Job Applicaion Removed');

    }
}
