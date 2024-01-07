<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Pickup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PickupController extends Controller
{
    public function __construct()
    {
        $this->middleware('isLoggedIn');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            if (Session::has('loginId')) {
                $admin = Admin::where('id', '=', Session::get('loginId'))->first();
            }
            $pickups = Pickup::paginate(10);
            return view('server.pages.pickupman-table', compact('pickups', 'admin'));
        } catch (\Throwable $th) {
            return view('marchant.pages.404');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            if (Session::has('loginId')) {
                $admin = Admin::where('id', '=', Session::get('loginId'))->first();
            }
            $users = User::all();
            return view('server.pages.pickupman-create', compact('users', 'admin'));
        } catch (\Throwable $th) {
            return view('marchant.pages.404');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'user_id' => 'required',
                'phone' => 'required|string|max:15',
                'alt_phone' => 'required|string|max:15',
                'email' => 'required',
                'address' => 'required|string|max:255',
                'divisions' => 'required|string',
                'district' => 'required|string',
                'ps' => 'required|string',
            ]);
            $pickup = new Pickup($request->all());

            $pickup->save();

            return redirect()->route('pickup.index')->with('success', 'Pickup Man created successfully.');
        } catch (\Throwable $th) {
            return view('marchant.pages.404');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pickup $pickup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pickup $pickup)
    {
        try {
            if (Session::has('loginId')) {
                $admin = Admin::where('id', '=', Session::get('loginId'))->first();
            }
            return view('server.pages.pickupman-edit', compact('pickup', 'admin'));
        } catch (\Throwable $th) {
            return view('marchant.pages.404');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pickup $pickup)
    {
        try {
            $pickup->update($request->all());
            return redirect('pickup')->withSuccess('Update successfully.');
        } catch (\Throwable $th) {
            return view('marchant.pages.404');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pickup $pickup)
    {
        try {
            $pickup->delete();
            return redirect('pickup')->withSuccess('Delete successfully.');
        } catch (\Throwable $th) {
            return view('marchant.pages.404');
        }
    }
}
