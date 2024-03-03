<?php

namespace App\Http\Controllers\Client;

use App\Models\Deliverycharge;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function home()
    {
        $fromLocations = Deliverycharge::select('from_location')->distinct()->get();
        return view('welcome', compact('fromLocations'));
    }

    public function getDestinations(Request $request)
    {

        $destinations = Deliverycharge::where('from_location', $request->from_location)->select('destination')->distinct()->get();
        return response()->json($destinations);
    }

    public function getCategories(Request $request)
    {

        $categories = Deliverycharge::where('destination', $request->destination)->select('category')->distinct()->get();
        return response()->json($categories);
    }

    public function getServices(Request $request)
    {

        $services = Deliverycharge::where('destination', $request->destination)->select('delivery_type')->distinct()->get();
        return response()->json($services);
    }
    public function tracking()
    {

        return view('client.pages.tracking');
    }

    public function contact()
    {

        return view('client.pages.contact');
    }

    public function service()
    {

        return view('client.pages.service');
    }

    public function about()
    {

        return view('client.pages.about');
    }
}
