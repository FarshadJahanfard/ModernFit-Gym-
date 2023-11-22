<?php

namespace App\Http\Controllers;

use App\Mail\DayPassMail;
use App\Models\Branch;
use App\Models\DayPass;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Validator;

class DayPassController extends Controller
{
    use Notifiable;
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

        $branch_id = $request->input('branch_id');

        $dayPass = new DayPass([
            'email' => $request->input('email'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'branch_id' => $branch_id,
            'passcode' => $passcode,
        ]);

        $dayPass->save();

        Mail::to($request->input('email'))->send(new DayPassMail($dayPass));

        return redirect('/daypass/' . $dayPass->id)->with('success', 'Day Pass created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($passId)
    {
        try {
            $dayPass = DayPass::findOrFail($passId);
        } catch (ModelNotFoundException $exception) {
            abort(404);
        }

        return view('daypasses.show', compact('dayPass'));
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
