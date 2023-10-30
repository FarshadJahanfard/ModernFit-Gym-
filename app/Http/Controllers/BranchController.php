<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class BranchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $branches = Branch::all();
        return view('branches.index', compact('branches'));
    }

    public function create()
    {
        return view('branches.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:branches',
            'location' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Branch::create([
            'name' => $request->input('name'),
            'location' => $request->input('location'),
        ]);

        return redirect()->route('branches')->with('success', 'Branch created successfully');
    }

    public function show($id)
    {
        $branch = Branch::findOrFail($id);
        $users = User::where('branch_id', $branch->id)->paginate(10); // Assuming branch_id is the foreign key in the User model

        return view('branches.show', compact('branch', 'users'));
    }

    public function edit($id)
    {
        $branch = Branch::findOrFail($id);
        return view('branches.edit', compact('branch'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:branches,name,' . $id,
            'location' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $branch = Branch::findOrFail($id);
        $branch->name = $request->input('name');
        $branch->location = $request->input('location');
        $branch->save();

        return redirect()->route('branches')->with('success', 'Branch updated successfully');
    }

    public function destroy($id)
    {
        $branch = Branch::findOrFail($id);
        $branch->delete();

        return redirect()->route('branches')->with('success', 'Branch deleted successfully');
    }
}
