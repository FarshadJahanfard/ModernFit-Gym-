<?php
namespace App\Http\Controllers;

use App\Mail\MembershipMail;
use App\Models\Branch;
use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Validator;
use Auth;

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

    public function show()
    {
        $memberships = Membership::all();
        $branches = Branch::all();
        return view('memberships.info', compact('memberships', 'branches'));
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

    public function purchase($membershipId)
    {
        $user = Auth::user();

        // Check if the user already has an active membership
        $activeMembership = $user->activeMembership();

        if ($activeMembership) {
            return redirect()->route('memberships.info')->with('error', 'You already have an active membership.');
        }

        // If no membership found, proceed to purchase a new one
        $startDate = now();
        $endDate = $startDate->copy()->addMonth();
        $branchId = request('branch');

        $passcode = mt_rand(10000000, 99999999);
        // Attach the membership to the user with the additional information
        $user->memberships()->attach($membershipId, [
            'start_date' => $startDate,
            'end_date' => $endDate,
            'passcode' => $passcode,
            'branch_id' => $branchId
        ]);

        Mail::to($user->email)->send(new MembershipMail($user->activeMembership()));

        return redirect()->route('memberships.info')->with('success', 'Membership purchased successfully.');
    }
}

