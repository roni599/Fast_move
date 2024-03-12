<?php

namespace App\Http\Controllers\Marchant;

use App\Http\Controllers\Controller;
use App\Models\Deliverycharge;
use Ramsey\Uuid\Uuid;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class MarchantDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {

        $id = Auth::user()->id;
        $marchant = User::where('id', '=', $id)->get();
        // $marchant = User::all();
        
        return view('marchant-dashboard', compact('marchant'));
    }

    public function coverageArea()
    {

        return view('marchant.pages.coverage-area');
    }

    public function productCreate()
    {
        $id = Auth::id();
        $uuid = Uuid::uuid4()->toString();
        $uuid = str_replace("-", "", $uuid);
        $firstFiveChars = substr($uuid, 0, 5);
        $numericValue = hexdec($firstFiveChars);
        return view('marchant.pages.delivery-create', compact('id', 'numericValue'));
    }

    // public function productStore(Request $request){
    //     $request->validate([
    //         'product_category' => 'required|string',
    //         'customer_name' => 'required|string|max:255',
    //         'customer_phone' => 'required|string|max:15',
    //         'full_address' => 'required|string|max:255',
    //         'divisions' => 'required|string',
    //         'district' => 'required|string',
    //         'police_station' => 'required|string',
    //         'delivery_type' => 'required|string',
    //         'cod_amount' => 'required|numeric',
    //         'invoice' => 'required|string',
    //         'note' => 'required|string',
    //         'product_weight' => 'required',
    //         'exchange_status' => 'required',
    //         'delivery_charge' => 'required',
    //     ]);

    //     dd($request->all()); 
    //     $product = new Product;
    //     $product->product_category = $request->product_category;
    //     $product->customer_name = $request->customer_name;
    //     $product->customer_phone = $request->customer_phone;
    //     $product->full_address = $request->full_address;
    //     $product->divisions = $request->divisions;
    //     $product->district = $request->district;
    //     $product->police_station = $request->police_station;
    //     $product->delivery_type = $request->delivery_type;
    //     $product->cod_amount = $request->cod_amount;
    //     $product->invoice = $request->invoice;
    //     $product->note = $request->note;
    //     $product->product_weight = $request->product_weight;
    //     $product->exchange_status = $request->exchange_status;
    //     $product->delivery_charge = $request->delivery_charge;

    //     $product->save();
    //     return redirect('admin/product/delivery')->withSuccess('Update successfully.');
    // }

    // public function pricing()
    // {

    //     try {
    //         $fromLocations = Deliverycharge::select('from_location')->distinct()->get();
    //         return view('marchant.pages.pricing', compact('fromLocations'));
    //     } catch (\Throwable $th) {
    //         return view('marchant.pages.404');
    //     }
    // }

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
