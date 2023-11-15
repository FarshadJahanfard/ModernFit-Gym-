<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\DayPass;
use Illuminate\Contracts\Notifications\Dispatcher;
use Illuminate\Http\Request;
use Validator;

class DayPassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = Branch::all();

        return view('daypasses.create')->with("branches", $branches);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'branch_id' => [
                'required',
                'exists:branches,id',
            ],
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $passcode = mt_rand(10000000, 99999999); // Generate an 8-digit passcode

        $branch_id = $request->input('branch_id') ?? 3;

        $dayPass = new DayPass([
            'email' => $request->input('email'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'branch_id' => $branch_id,
            'passcode' => $passcode,
        ]);

//        $dayPass->save();

        // Send an email with the passcode to the user (You need to implement this part)

        return redirect()
            ->route('day-passes.show', ['day_pass' => $dayPass->id])
            ->with('success', 'Day Pass created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
