<?php

namespace App\Http\Controllers\Client;

use App\Models\Deliverycharge;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function home()
    {
        try {
            $fromLocations = Deliverycharge::select('from_location')->distinct()->get();
            return view('welcome', compact('fromLocations'));
        } catch (\Throwable $th) {
            return view('marchant.pages.404');
        }
    }

    public function getDestinations(Request $request)
    {
        try {
            $destinations = Deliverycharge::where('from_location', $request->from_location)->select('destination')->distinct()->get();
            return response()->json($destinations);
        } catch (\Throwable $th) {
            return view('marchant.pages.404');
        }
    }

    public function getCategories(Request $request)
    {
        try {
            $categories = Deliverycharge::where('destination', $request->destination)->select('category')->distinct()->get();
            return response()->json($categories);
        } catch (\Throwable $th) {
            return view('marchant.pages.404');
        }
    }


    public function tracking()
    {
        try {
            return view('client.pages.tracking');
        } catch (\Throwable $th) {
            return view('marchant.pages.404');
        }
    }

    public function contact()
    {
        try {
            return view('client.pages.contact');
        } catch (\Throwable $th) {
            return view('marchant.pages.404');
        }
    }

    public function service()
    {
        try {
            return view('client.pages.service');
        } catch (\Throwable $th) {
            return view('marchant.pages.404');
        }
    }

    public function about()
    {
        try {
            return view('client.pages.about');
        } catch (\Throwable $th) {
            return view('marchant.pages.404');
        }
    }
}
