<?php

namespace App\Http\Controllers\Marchant;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use App\Models\Fraud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FraudController extends Controller
{
    public function fraud_check()
    {
        try {
            $frauds = Fraud::all();
            $formattedFrauds = $frauds->map(function ($fraud) {
                $fraud->formattedPhoneNumber = substr($fraud->phone_number, 0, 5) . '***' . substr($fraud->phone_number, -3);
                return $fraud;
            });
            return view('marchant.pages.fraud_check', compact('formattedFrauds'));
        } catch (\Throwable $th) {
            return view('marchant.pages.404');
        }
    }
    public function fraud_add_new()
    {
        try {
            $user_id = Auth::user()->id;
            return view('marchant.pages.fraud_add_new', compact('user_id'));
        } catch (\Throwable $th) {
            return view('marchant.pages.404');
        }
    }
    public function fraud_add_new_insert(Request $request)
    {
        try {
            Validator::make($request->all(), [
                'phone_number' => 'required',
                'disputant_name' => 'required',
                'details' => 'required',
                'steadfast_parcel_id' => 'nullable',
                'user_id' => 'nullable',
            ]);
            $fraud = new Fraud();
            $fraud->phone_number = $request->phone_number;
            $fraud->disputant_name = $request->disputant_name;
            $fraud->details = $request->details;
            $fraud->steadfast_parcel_id = $request->steadfast_parcel_id;
            $fraud->user_id = $request->user_id;
            $fraud->save();
            return redirect()->back()->with('message', 'Fraud Added Successfully');
        } catch (\Throwable $th) {
            return view('marchant.pages.404');
        }
    }
    public function fraud_check_search()
    {
        try {
            return view('marchant.pages.fraud_check_search');
        } catch (\Throwable $th) {
            return view('marchant.pages.404');
        }
    }
    public function fraud_myentries()
    {
        try {
            $id = Auth::user()->id;
            $frauds = Fraud::where('user_id', '=', $id)->get();
            $formattedFrauds = $frauds->map(function ($fraud) {
                $fraud->formattedPhoneNumber = substr($fraud->phone_number, 0, 5) . '***' . substr($fraud->phone_number, -3);
                return $fraud;
            });
            return view('marchant.pages.myentries', compact('formattedFrauds'));
        } catch (\Throwable $th) {
            return view('marchant.pages.404');
        }
    }
    public function fraud_search(Request $request)
    {
        try {
            $request->validate([
                'phone_number' => 'required|numeric|digits:11',
            ]);
            $phone_number = $request->input('phone_number');

            $result = Fraud::where('phone_number', '=', $phone_number)->get();
            return response()->json(['result' => $result]);
        } catch (\Throwable $th) {
            return view('marchant.pages.404');
        }
    }
    public function fraud_delete($id)
    {
        try {
            $fraud = Fraud::findOrFail($id);
            $fraud->delete();
            return redirect()->back()->with('message', 'Fraud record remove successfully');
        } catch (\Throwable $th) {
            return view('marchant.pages.404');
        }
    }

    public function search(Request $request)
    {
        try {
            $searchTerm = $request->input('search');
            $deliveries = Delivery::where('delivery_type', 'LIKE', "%$searchTerm%")
                ->orWhere('name', 'LIKE', "%$searchTerm%")
                ->orWhere('phone', 'LIKE', "%$searchTerm%")
                ->orWhere('address', 'LIKE', "%$searchTerm%")
                ->orWhere('category_type', 'LIKE', "%$searchTerm%")
                ->orWhere('district', 'LIKE', "%$searchTerm%")
                ->orWhere('order_tracking_id', 'LIKE', "%$searchTerm%")
                ->orWhere('divisions', 'LIKE', "%$searchTerm%")
                ->get();
            return response()->json(['deliveries' => $deliveries]);
        } catch (\Throwable $th) {
            return view('marchant.pages.404');
        }
    }
    public function optionsearch(Request $request)
    {
        try {
            $searchTerm = $request->input('search');
            $searchTerm2 = $request->input('search2');
            $searchTerm3 = $request->input('search3');
            $query = Delivery::query();

            if ($searchTerm) {
                $query->where('divisions', $searchTerm);
            }

            if ($searchTerm2) {
                $query->where('district', $searchTerm2);
            }

            if ($searchTerm3) {
                $query->where('police_station', $searchTerm3);
            }
            $deliveries = $query->get();
            $formattedData = [];

            foreach ($deliveries as $delivery) {
                $formattedData[] = [
                    'id' => $delivery->id,
                    'name' => $delivery->name,
                    'phone' => $delivery->phone,
                    'address' => $delivery->address,
                    'divisions' => $delivery->divisions,
                    'district' => $delivery->district,
                    'police_station' => $delivery->police_station,
                    'category_type' => $delivery->category_type,
                    'delivery_type' => $delivery->delivery_type,
                    'order_tracking_id' => $delivery->order_tracking_id,
                    'cod_amount' => $delivery->cod_amount,
                    'invoice' => $delivery->invoice,
                    'note' => $delivery->note,
                    'weight' => $delivery->weight,
                    'exchange_parcel' => $delivery->exchange_parcel,
                    'created_at' => $delivery->created_at,
                    'updated_at' => $delivery->updated_at,
                    'is_active' => $delivery->is_active,
                ];
            }
            return response()->json(['deliveries' => $formattedData]);
        } catch (\Throwable $th) {
            return view('marchant.pages.404');
        }
    }
}
