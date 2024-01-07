<?php

namespace App\Http\Controllers\Marchant;

use App\Http\Controllers\Controller;
use App\Models\Deliverycharge;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class MarchantDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        try {
            $id = Auth::user()->id;
            $marchant = User::where('id', '=', $id)->get();
            // $marchant = User::all();
            return view('marchant-dashboard', compact('marchant'));
        } catch (\Throwable $th) {
            return view('marchant.pages.404');
        }
    }

    public function coverageArea()
    {
        try {
            return view('marchant.pages.coverage-area');
        } catch (\Throwable $th) {
            return view('marchant.pages.404');
        }
    }

    public function pricing()
    {

        try {
            $fromLocations = Deliverycharge::select('from_location')->distinct()->get();
            return view('marchant.pages.pricing', compact('fromLocations'));
        } catch (\Throwable $th) {
            return view('marchant.pages.404');
        }
    }

    // public function deliveryConfirmation(Request $request)
    // {
    //     $delivery = Delivery::find($request->id);
    //     $delivery->is_active = 2;

    //     $delivery->update();

    //     return redirect('/delivery');
    // }

    // public function deliveryCheckout(Request $request)
    // {
    //     $delivery = Delivery::find($request->id);
    //     $delivery->is_active = 3;

    //     $delivery->update();

    //     return redirect('/delivery');
    // }
    // public function cancelConfirmation(Request $request){
    //     $delivery = Delivery::find($request->id);
    //     $delivery->is_active = 'canceled';
    //     $delivery->update();
    //     return redirect('/delivery');
    // }

}
