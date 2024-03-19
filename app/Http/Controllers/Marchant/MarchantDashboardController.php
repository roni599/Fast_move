<?php

namespace App\Http\Controllers\Marchant;

use App\Http\Controllers\Controller;
use App\Models\Deliverycharge;
use Ramsey\Uuid\Uuid;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;

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


    public function searchme(Request $request)
    {

        $searchTerm = $request->input('admin_delivery_search');
        $deliveries = Product::where('delivery_type', 'LIKE', "%$searchTerm%")
            ->orWhere('customer_name', 'LIKE', "%$searchTerm%")
            ->orWhere('customer_phone', 'LIKE', "%$searchTerm%")
            ->orWhere('full_address', 'LIKE', "%$searchTerm%")
            ->orWhere('product_category', 'LIKE', "%$searchTerm%")
            ->orWhere('district', 'LIKE', "%$searchTerm%")
            ->orWhere('order_tracking_id', 'LIKE', "%$searchTerm%")
            ->orWhere('divisions', 'LIKE', "%$searchTerm%")
            ->get();
        $tableHtml = '<div class="table-responsive">';
        $tableHtml .= '<table class="table table-bordered" id="table">';
        $tableHtml .= '<thead>';
        $tableHtml .= '<tr>';
        $tableHtml .= '<th scope="col">ID</th>';
        $tableHtml .= '<th scope="col">Customer Name</th>';
        $tableHtml .= '<th scope="col">Customer Phone</th>';
        $tableHtml .= '<th scope="col">Address</th>';
        $tableHtml .= '<th scope="col">Police Station</th>';
        $tableHtml .= '<th scope="col">District</th>';
        $tableHtml .= '<th scope="col">Division</th>';
        $tableHtml .= '<th scope="col">Product Category</th>';
        $tableHtml .= '<th scope="col">Delivery Type</th>';
        $tableHtml .= '<th scope="col">Tracking Id</th>';
        $tableHtml .= '<th scope="col">Invoice</th>';
        $tableHtml .= '<th scope="col">Note</th>';
        $tableHtml .= '<th scope="col">Exchange Status</th>';
        $tableHtml .= '<th scope="col">Delivery Charge</th>';
        $tableHtml .= '<th scope="col">Product Price</th>';
        $tableHtml .= '<th scope="col">Product weight</th>';
        $tableHtml .= '<th scope="col">Status</th>';
        $tableHtml .= '<th scope="col">Action</th>';
        $tableHtml .= '</tr>';
        $tableHtml .= '</thead>';
        $tableHtml .= '<tbody>';

        foreach ($deliveries as $delivery) {
            $tableHtml .= '<tr class="table-info">';
            $tableHtml .= '<td>' . $delivery->id . '</td>';
            $tableHtml .= '<td>' . $delivery->customer_name . '</td>';
            $tableHtml .= '<td>' . $delivery->customer_phone . '</td>';
            $tableHtml .= '<td>' . $delivery->address . '</td>';
            $tableHtml .= '<td>' . $delivery->police_station . '</td>';
            $tableHtml .= '<td>' . $delivery->district . '</td>';
            $tableHtml .= '<td>' . $delivery->divisions . '</td>';
            $tableHtml .= '<td>' . $delivery->product_category . '</td>';
            $tableHtml .= '<td>' . $delivery->delivery_type . '</td>';
            $tableHtml .= '<td>' . $delivery->order_tracking_id . '</td>';
            $tableHtml .= '<td>' . $delivery->invoice . '</td>';
            $tableHtml .= '<td>' . $delivery->note . '</td>';
            $tableHtml .= '<td>' . $delivery->exchange_status . '</td>';
            $tableHtml .= '<td>' . $delivery->delivery_charge . '</td>';
            $tableHtml .= '<td>' . $delivery->cod_amount . '</td>';
            $tableHtml .= '<td>' . $delivery->product_weight . '</td>';
            $tableHtml .= '<td>';
            // Add conditions for status badges here
            if ($delivery->is_active === '1') {
                $tableHtml .= '<span class="badge bg-label-danger me-1 text-dark">Awaiting response for Pickupman</span>';
            } elseif ($delivery->is_active === '2') {
                $tableHtml .= '<span class="badge bg-label-danger me-1 text-dark">Product On the way</span>';
            } elseif ($delivery->is_active === '3') {
                $tableHtml .= '<span class="badge bg-label-danger me-1 text-dark">Product Stocked</span>';
            } elseif ($delivery->is_active === '4') {
                $tableHtml .= '<span class="badge bg-label-danger me-1 text-dark">Product Shipped</span>';
            } elseif ($delivery->is_active === '5') {
                $tableHtml .= '<span class="badge bg-label-danger me-1 text-dark">Product Delivered</span>';
            } elseif ($delivery->is_active === '6') {
                $tableHtml .= '<span class="badge bg-label-danger me-1 text-dark">Product Return</span>';
            } elseif ($delivery->is_active === '7') {
                $tableHtml .= '<span class="badge bg-label-success me-1 text-dark">Product Cancelled</span>';
            } elseif ($delivery->is_active === 'cancelled') {
                $tableHtml .= '<span class="badge bg-label-success me-1 text-dark">Product Cancelled by the admin</span>';
            }
            $tableHtml .= '</td>';
            if ($delivery->is_active === 'cancelled') {
                $tableHtml .= '<td>';
                $tableHtml .= '<span class="badge bg-label-success me-1 text-dark">No action <br> Available</span>';
                $tableHtml .= '</td>';
            } else {
                $tableHtml .= '<td>';
                $tableHtml .= '<div class="d-flex justify-content-center gap-2">';
                $tableHtml .= '<button class="btn btn-sm btn-success showMerchantProductButton" data-bs-toggle="modal" data-bs-target="#showMerchantproductModal" data-id="' . $delivery->id . '" data-customer_name="' . $delivery->customer_name . '" data-customer_phone="' . $delivery->customer_phone . '" data-full_address="' . $delivery->full_address . '" data-police_station="' . $delivery->police_station . '" data-district="' . $delivery->district . '" data-divisions="' . $delivery->divisions . '" data-product_category="' . $delivery->product_category . '" data-delivery_type="' . $delivery->delivery_type . '" data-amount="' . $delivery->cod_amount . '" data-status="' . $delivery->is_active . '" data-order_tracking_id="' . $delivery->order_tracking_id . '" data-invoice="' . $delivery->invoice . '" data-note="' . $delivery->note . '" data-weight="' . $delivery->product_weight . '" data-exchange_status="' . $delivery->exchange_status . '" data-delivery_charge="' . $delivery->delivery_charge . '" id="showProductMerchantForm"><i class="fas fa-eye"></i></button>';
                $tableHtml .= '<button class="btn btn-sm btn-success merchantProductEditModal" data-bs-toggle="modal" data-bs-target="#merchantProductEditModal" data-idtoedit="' . $delivery->id . '" data-customer_nametoedit="' . $delivery->customer_name . '" data-customer_phonetoedit="' . $delivery->customer_phone . '" data-full_addresstoedit="' . $delivery->full_address . '" data-police_stationtoedit="' . $delivery->police_station . '" data-districttoedit="' . $delivery->district . '" data-divisionstoedit="' . $delivery->divisions . '" data-product_categorytoedit="' . $delivery->product_category . '" data-delivery_typetoedit="' . $delivery->delivery_type . '" data-amounttoedit="' . $delivery->cod_amount . '" data-statustoedit="' . $delivery->is_active . '" data-order_tracking_idtoedit="' . $delivery->order_tracking_id . '" data-invoicetoedit="' . $delivery->invoice . '" data-notetoedit="' . $delivery->note . '" data-exchange_statustoedit="' . $delivery->exchange_status . '" data-delivery_chargetoedit="' . $delivery->delivery_charge . '" data-weighttoedit="' . $delivery->product_weight . '" id="updateDeliveryForm"><i class="fas fa-pencil-alt"></i></button>';
                $tableHtml .= '<form class="" id="merchantProductDeleteConformation" action="' . route('product.destroy', $delivery->id) . '" method="post">';
                $tableHtml .= csrf_field();
                $tableHtml .= method_field('DELETE');
                $tableHtml .= '<button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')">';
                $tableHtml .= '<i class="fas fa-trash-alt"></i>';
                $tableHtml .= '</button>';
                $tableHtml .= '</form>';
                $tableHtml .= '</td>';
                $tableHtml .= '</tr>';
            }
        }
        $tableHtml .= '</tbody>';
        $tableHtml .= '</table>';
        $tableHtml .= '</div>';
        return $tableHtml;
    }

    // public function searchme(Request $request)
    // {
    //     $searchTerm = $request->input('admin_delivery_search');
    //     $deliveries = Product::where('delivery_type', 'LIKE', "%$searchTerm%")
    //         ->orWhere('name', 'LIKE', "%$searchTerm%")
    //         ->orWhere('phone', 'LIKE', "%$searchTerm%")
    //         ->orWhere('address', 'LIKE', "%$searchTerm%")
    //         ->orWhere('category_type', 'LIKE', "%$searchTerm%")
    //         ->orWhere('district', 'LIKE', "%$searchTerm%")
    //         ->orWhere('order_tracking_id', 'LIKE', "%$searchTerm%")
    //         ->orWhere('divisions', 'LIKE', "%$searchTerm%")
    //         ->get();

    //     // Build the table HTML
    //     $tableHtml = '<div class="table-responsive">';
    //     $tableHtml .= '<table class="table table-bordered" id="tableto">';
    //     $tableHtml .= '<thead>';
    //     $tableHtml .= '<tr>';
    //     $tableHtml .= '<th scope="col">ID</th>';
    //     $tableHtml .= '<th scope="col">Customer Name</th>';
    //     $tableHtml .= '<th scope="col">Customer Phone</th>';
    //     $tableHtml .= '<th scope="col">Address</th>';
    //     $tableHtml .= '<th scope="col">Police Station</th>';
    //     $tableHtml .= '<th scope="col">District</th>';
    //     $tableHtml .= '<th scope="col">Division</th>';
    //     $tableHtml .= '<th scope="col">Product Category</th>';
    //     $tableHtml .= '<th scope="col">Delivery Type</th>';
    //     $tableHtml .= '<th scope="col">Tracking Id</th>';
    //     $tableHtml .= '<th scope="col">Invoice</th>';
    //     $tableHtml .= '<th scope="col">Note</th>';
    //     $tableHtml .= '<th scope="col">Exchange Status</th>';
    //     $tableHtml .= '<th scope="col">Delivery Charge</th>';
    //     $tableHtml .= '<th scope="col">Product Price</th>';
    //     $tableHtml .= '<th scope="col">Product weight</th>';
    //     $tableHtml .= '<th scope="col">Status</th>';
    //     $tableHtml .= '<th scope="col">Action</th>';
    //     $tableHtml .= '</tr>';
    //     $tableHtml .= '</thead>';
    //     $tableHtml .= '<tbody>';

    //     foreach ($deliveries as $delivery) {
    //         $tableHtml .= '<tr class="table-info">';
    //         $tableHtml .= '<td>' . $delivery->id . '</td>';
    //         $tableHtml .= '<td>' . $delivery->customer_name . '</td>';
    //         $tableHtml .= '<td>' . $delivery->customer_phone . '</td>';
    //         $tableHtml .= '<td>' . $delivery->address . '</td>';
    //         $tableHtml .= '<td>' . $delivery->police_station . '</td>';
    //         $tableHtml .= '<td>' . $delivery->district . '</td>';
    //         $tableHtml .= '<td>' . $delivery->divisions . '</td>';
    //         $tableHtml .= '<td>' . $delivery->product_category . '</td>';
    //         $tableHtml .= '<td>' . $delivery->delivery_type . '</td>';
    //         $tableHtml .= '<td>' . $delivery->order_tracking_id . '</td>';
    //         $tableHtml .= '<td>' . $delivery->invoice . '</td>';
    //         $tableHtml .= '<td>' . $delivery->note . '</td>';
    //         $tableHtml .= '<td>' . $delivery->exchange_status . '</td>';
    //         $tableHtml .= '<td>' . $delivery->delivery_charge . '</td>';
    //         $tableHtml .= '<td>' . $delivery->cod_amount . '</td>';
    //         $tableHtml .= '<td>' . $delivery->product_weight . '</td>';
    //         $tableHtml .= '<td>';
    //         // Add conditions for status badges here
    //         if ($delivery->is_active === '1') {
    //             $tableHtml .= '<span class="badge bg-label-danger me-1 text-dark">Awaiting response for Pickupman</span>';
    //         } elseif ($delivery->is_active === '2') {
    //             $tableHtml .= '<span class="badge bg-label-danger me-1 text-dark">Product On the way</span>';
    //         } elseif ($delivery->is_active === '3') {
    //             $tableHtml .= '<span class="badge bg-label-danger me-1 text-dark">Product Stocked</span>';
    //         } elseif ($delivery->is_active === '4') {
    //             $tableHtml .= '<span class="badge bg-label-danger me-1 text-dark">Product Shipped</span>';
    //         } elseif ($delivery->is_active === '5') {
    //             $tableHtml .= '<span class="badge bg-label-danger me-1 text-dark">Product Delivered</span>';
    //         } elseif ($delivery->is_active === '6') {
    //             $tableHtml .= '<span class="badge bg-label-danger me-1 text-dark">Product Return</span>';
    //         } elseif ($delivery->is_active === '7') {
    //             $tableHtml .= '<span class="badge bg-label-success me-1 text-dark">Product Cancelled</span>';
    //         } elseif ($delivery->is_active === 'cancelled') {
    //             $tableHtml .= '<span class="badge bg-label-success me-1 text-dark">Product Cancelled by the admin</span>';
    //         }
    //         $tableHtml .= '</td>';
    //         $tableHtml .= '<td>';
    //         // Add actions buttons here
    //         $tableHtml .= '<div class="d-flex justify-content-center gap-2">';
    //         $tableHtml .= '<button class="btn btn-sm btn-success showMerchantProductButton" data-bs-toggle="modal" data-bs-target="#showMerchantproductModal" data-id="' . $delivery->id . '" data-customer_name="' . $delivery->customer_name . '" data-customer_phone="' . $delivery->customer_phone . '" data-full_address="' . $delivery->address . '" data-police_station="' . $delivery->police_station . '" data-district="' . $delivery->district . '" data-divisions="' . $delivery->divisions . '" data-product_category="' . $delivery->product_category . '" data-delivery_type="' . $delivery->delivery_type . '" data-amount="' . $delivery->cod_amount . '" data-status="' . $delivery->is_active . '" data-order_tracking_id="' . $delivery->order_tracking_id . '" data-invoice="' . $delivery->invoice . '" data-note="' . $delivery->note . '" data-weight="' . $delivery->product_weight . '" data-exchange_status="' . $delivery->exchange_status . '" data-delivery_charge="' . $delivery->delivery_charge . '" id="showProductMerchantForm"><i class="fas fa-eye"></i></button>';
    //         $tableHtml .= '<button class="btn btn-sm btn-success merchantProductEditModal" data-bs-toggle="modal" data-bs-target="#merchantProductEditModal" data-idtoedit="' . $delivery->id . '" data-customer_nametoedit="' . $delivery->customer_name . '" data-customer_phonetoedit="' . $delivery->customer_phone . '" data-full_addresstoedit="' . $delivery->address . '" data-police_stationtoedit="' . $delivery->police_station . '" data-districttoedit="' . $delivery->district . '" data-divisionstoedit="' . $delivery->divisions . '" data-product_categorytoedit="' . $delivery->product_category . '" data-delivery_typetoedit="' . $delivery->delivery_type . '" data-amounttoedit="' . $delivery->cod_amount . '" data-statustoedit="' . $delivery->is_active . '" data-order_tracking_idtoedit="' . $delivery->order_tracking_id . '" data-invoicetoedit="' . $delivery->invoice . '" data-notetoedit="' . $delivery->note . '" data-exchange_statustoedit="' . $delivery->exchange_status . '" data-delivery_chargetoedit="' . $delivery->delivery_charge . '" data-weighttoedit="' . $delivery->product_weight . '" id="updateDeliveryForm"><i class="fas fa-pencil-alt"></i></button>';
    //         $tableHtml .= '<form id="merchantProductDeleteConformation" action="' . route('product.destroy', $delivery->id) . '" method="post">';
    //         $tableHtml .= csrf_field();
    //         $tableHtml .= '</td>';
    //         $tableHtml .= '</tr>';
    //     }
    //     $tableHtml .= '</tbody>';
    //     $tableHtml .= '</table>';
    //     $tableHtml .= '</div>';
    //     // return response()->json(['html' => $tableHtml]);
    //     // Return the HTML table
    //     return $tableHtml;
    // }
}
