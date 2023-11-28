<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;

class EmployerController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Employer::class);
    }

    public function create()
    {
        return view("employer.create");
    }

    public function store(Request $request)
    {

        // auth()->user()->employer()->create([
        //     $request->validate([
        //         'company_name' => 'required|min:3|unique:employers,company_name',
        //     ])
        // ]);

        $validatedData = $request->validate([
            'company_name' => 'required|min:3|unique:employers,company_name',
        ]);
        $validatedData = array_merge($validatedData, ['user_id' => request()->user()->id]);
        // dd($validatedData);

        Employer::create($validatedData);

        return redirect()->route('jobs.index')
            ->with('success', 'You succefully registerd as employer!');
    }
}
