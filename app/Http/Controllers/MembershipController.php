<?php
namespace App\Http\Controllers;

use App\Models\Membership;
use Illuminate\Http\Request;
use Validator;

class MembershipController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $memberships = Membership::all();
        return view('memberships.index', compact('memberships'));
    }

    public function create()
    {
        return view('memberships.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:memberships',
            'price' => 'required|numeric',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Membership::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('memberships')->with('success', 'Membership created successfully');
    }

    public function edit($id)
    {
        $membership = Membership::findOrFail($id);
        return view('memberships.edit', compact('membership'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:memberships,name,' . $id,
            'price' => 'required|numeric',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $membership = Membership::findOrFail($id);
        $membership->name = $request->input('name');
        $membership->price = $request->input('price');
        $membership->description = $request->input('description');
        $membership->save();

        return redirect()->route('memberships')->with('success', 'Membership updated successfully');
    }

    public function destroy($id)
    {
        $membership = Membership::findOrFail($id);
        $membership->delete();

        return redirect()->route('memberships')->with('success', 'Membership deleted successfully');
    }
}

