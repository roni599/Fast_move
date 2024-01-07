<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Delivery;
use App\Models\Deliverycharge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class DeliverychargeController extends Controller
{
    public function addDeliveryCharge()
    {
        try {
            if (Session::has('loginId')) {
                $admin = Admin::where('id', '=', Session::get('loginId'))->first();
            }
            return view('server.pages.calculator-create', compact('admin'));
        } catch (\Throwable $th) {
            return view('marchant.pages.404');
        }
    }
    public function storeDeliveryCharge(Request $request)
    {
        try {
            Validator::make($request->all(), [
                'from' => 'required|string|max:255',
                'destination' => 'required|string|max:255',
                'category' => 'required|string|max:255',
                'service_regular' => 'required|numeric|min:0',
                'service_same_day' => 'required|numeric|min:0',
            ]);
            $deliveryCharge = new Deliverycharge();

            $deliveryCharge->from_location = $request->from;
            $deliveryCharge->destination = $request->destination;
            $deliveryCharge->category = $request->category;
            $deliveryCharge->regular = $request->service_regular;
            $deliveryCharge->same_day = $request->service_same_day;
            $deliveryCharge->save();
            return redirect()->back()->with('message', 'Delivery Charge Added Successfully');
        } catch (\Throwable $th) {
            return view('marchant.pages.404');
        }
    }
    public function calculate_delivery_charge(Request $request)
    {
        try {
            $fromLocation = $request->input('from_location');
            $destination = $request->input('destination');
            $service = $request->input('service');
            $weight = $request->input('weight');

            $deliveryCharge = DeliveryCharge::where([
                'from_location' => $fromLocation,
                'destination' => $destination,
            ])->first();

            if ($deliveryCharge) {
                $finalPrice = $service === '1' ? $deliveryCharge->regular : $deliveryCharge->same_day;
                $finalPrice *= $weight;

                return response()->json([
                    'deliveryCharge' => [
                        'price' => $finalPrice,
                    ]
                ]);
            } else {
                return response()->json([
                    'error' => 'Invalid delivery charge',
                ], 400);
            }
        } catch (\Throwable $th) {
            return view('marchant.pages.404');
        }
    }
    public function search(Request $request)
    {
        try {
            $trackingId = $request->input('tracking_id');
            $delivery = Delivery::where('order_tracking_id', $trackingId)->first();
            return response()->json(['delivery' => $delivery]);
        } catch (\Throwable $th) {
            return view('marchant.pages.404');
        }
    }
}
