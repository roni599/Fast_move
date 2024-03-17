<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AdminExport;
use App\Exports\DeliverymanExport;
use App\Exports\PickupmaExport;
use App\Exports\ProductExport;
use App\Http\Controllers\Controller;
use App\Imports\AdminImport;
use App\Imports\DeliverymanImport;
use App\Imports\PickupmanImport;
use App\Imports\ProductImport;
use App\Models\Admin;
use App\Models\Deliverycharge;
use App\Models\Deliveryman;
use App\Models\Pickupman;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function index()
    {

        $admin = array();
        if (Session::has('loginId')) {
            $admin = Admin::where('id', '=', Session::get('loginId'))->first();
        }
        return view('admin-dashboard', compact('admin'));
    }

    public function create()
    {

        $admin = array();
        if (Session::has('loginId')) {
            $admin = Admin::where('id', '=', Session::get('loginId'))->first();
        }
        return view('server.auth.admin-registration', compact('admin'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'admin_name' => 'required',
            'designation' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'password' => 'required|min:8|confirmed',
            'address' => 'required',
            'role' => 'required',
            'profile_img' => 'required',
        ]);

        $admin = new Admin;
        $admin->admin_name = $request->admin_name;
        $admin->designation = $request->designation;
        $admin->phone = $request->phone;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->address = $request->address;
        $admin->role = $request->role;

        if ($request->hasFile('profile_img')) {
            $file = $request->file('profile_img');
            $filename = $admin->admin_name . '_' . $request->profile_img->getClientOriginalName();
            $file->move('admins/profile_images/', $filename);
            $admin->profile_img = $filename;
        }

        $admin->save();
        // Admin::create($request->all());

        return redirect('admin/table')->withSuccess('Admin added successfully.');
    }

    public function loginView()
    {

        return view('server.auth.admin-login');
    }

    function loginCheck(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $admin = Admin::where('email', '=', $request->email)->where('role', '=', $request->role)->first();

        if ($admin) {
            if (Hash::check($request->password, $admin->password)) {
                $request->session()->put('loginId', $admin->id);
                // Log::channel('adminlogininfo')->info("User {id} successfully login.", ['id' => $admin->id]);
                return redirect('admin/dashboard');
            } else if ($request->password == $admin->password) {
                $request->session()->put('loginId', $admin->id);
                // Log::channel('adminlogininfo')->info("User {id} successfully login.", ['id' => $admin->id]);
                return redirect('admin/dashboard');
            } else {

                return back()->with('fail', 'Login details are not valid');
            }
        } else {
            return back()->with('fail', 'Login details are not valid');
        }
    }
    
    public function table()
    {

        $admin = array();
        if (Session::has('loginId')) {
            $admin = Admin::where('id', '=', Session::get('loginId'))->first();
        }

        $admins = Admin::paginate(10);
        return view('server.pages.admin-table',  compact('admins', 'admin'));
    }

    function logout()
    {

        if (Session::has('loginId')) {
            Session::pull('loginId');
            return redirect('admin/login');
        }
    }

    public function adminEdit(Request $request)
    {

        $id = Session::get('loginId');
        $admin = Admin::where('id', '=', $id)->first();
        // $admin = Admin::find($admin_id)->get(); 
        // dd($admin);
        return view('server.auth.admin-update', ['admin' => $admin]);
    }


    public function adminUpdate(Request $request)
    {
        $admin = Admin::find($request->id);
        $admin->admin_name = $request->admin_name;
        $admin->designation = $request->designation;
        $admin->phone = $request->phone;
        $admin->email = $request->email;
        $admin->address = $request->address;
        $admin->role = $request->role;
        if ($request->hasFile('profile_img')) {
            $destination = public_path('admins/profile_images/' . $admin->admin_name . '_' . $request->oldimage);
            if (file_exists($destination)) {
                unlink($destination);
            }
            $file = $request->file('profile_img');
            $filename = $admin->admin_name . '_' . $request->profile_img->getClientOriginalName();
            $file->move('admins/profile_images/', $filename);
            $admin->profile_img = $filename;
        }

        $admin->update();
        return redirect('admin/edit')->withSuccess('Admin update successfully.');
    }

    function changePassword()
    {
        $admin = array();
        if (Session::has('loginId')) {
            $admin = Admin::where('id', '=', Session::get('loginId'))->first();
        }

        return view('server.auth.admin-change-password', compact('admin'));
    }

    function updatePassword(Request $request)
    {

        $request->validate([
            'old_password' => 'required',
            'password' => 'required',

        ]);

        $id = Session::get('loginId');

        $admin = Admin::where('id', '=', $id)->first();
        if (Hash::check($request->old_password, $admin->password)) {
            $admin->password = Hash::make($request->password);
            $admin->update();

            return redirect('admin/change/password')->withSuccess('Update successfully.');
        } else {

            return redirect('admin/change/password')->withSuccess('Old Password Does not Match.');
        };
    }

    public function adminDelete(Request $request)
    {

        $admin = array();
        if (Session::has('loginId')) {
            $admin = Admin::where('id', '=', Session::get('loginId'))->first();
        }

        return view('server.auth.admin-account-delete', compact('admin'));
    }

    public function adminDeleteAccount(Request $request)
    {

        $request->validate([
            'password' => 'required',

        ]);

        $id = Session::get('loginId');

        $admin = Admin::where('id', '=', $id)->first();
        if (Hash::check($request->password, $admin->password)) {
            $admin->delete();
            return redirect('admin/register');
        } else {
            return redirect('admin/delete')->withSuccess('Invalid Password.');
        };
    }

    public function adminDestroy(Request $request)
    {
        Admin::find($request->id)->delete();
        return redirect('admin/table')->withSuccess('Admin Deleted');
    }
    public function searchAdmin(Request $request)
    {

        $search = $request->input('admin_delivery_search');

        $customers = Product::with(['pickupman:id,pickupman_name', 'deliveryman:id,deliveryman_name', 'user:id,merchant_name'])
            ->where(function ($query) use ($search) {
                $query->where('product_category', 'like', '%' . $search . '%')
                    ->orWhere('customer_name', 'like', '%' . $search . '%')
                    ->orWhere('customer_phone', 'like', '%' . $search . '%')
                    ->orWhere('full_address', 'like', '%' . $search . '%')
                    ->orWhere('divisions', 'like', '%' . $search . '%')
                    ->orWhere('district', 'like', '%' . $search . '%')
                    ->orWhere('police_station', 'like', '%' . $search . '%')
                    ->orWhere('delivery_type', 'like', '%' . $search . '%')
                    ->orWhere('order_tracking_id', 'like', '%' . $search . '%')
                    ->orWhere('cod_amount', 'like', '%' . $search . '%')
                    ->orWhere('invoice', 'like', '%' . $search . '%');
            })
            ->orWhereHas('user', function ($query) use ($search) {
                $query->where('merchant_name', 'like', '%' . $search . '%');
            })
            ->orWhereHas('pickupman', function ($query) use ($search) {
                $query->where('pickupman_name', 'like', '%' . $search . '%');
            })
            ->orWhereHas('deliveryman', function ($query) use ($search) {
                $query->where('deliveryman_name', 'like', '%' . $search . '%');
            })
            ->get();

        return response()->json(['customers' => $customers]);
    }


    public function searchPickup(Request $request)
    {
        $searchInput = $request->input('admin_delivery_search');
        $pickupmen = Pickupman::where('pickupman_name', 'like', '%' . $searchInput . '%')
            ->orWhere('phone', 'like', '%' . $searchInput . '%')
            ->orWhere('alt_phone', 'like', '%' . $searchInput . '%')
            ->orWhere('email', 'like', '%' . $searchInput . '%')
            ->orWhere('full_address', 'like', '%' . $searchInput . '%')
            ->orWhere('police_station', 'like', '%' . $searchInput . '%')
            ->orWhere('district', 'like', '%' . $searchInput . '%')
            ->orWhere('division', 'like', '%' . $searchInput . '%')
            ->get();

        return response()->json(['pickupmen' => $pickupmen]);
    }

    public function searchDeliveryman(Request $request)
    {
        $searchInput = $request->input('admin_delivery_search');
        $deliverymen = Deliveryman::where('deliveryman_name', 'like', '%' . $searchInput . '%')
            ->orWhere('phone', 'like', '%' . $searchInput . '%')
            ->orWhere('alt_phone', 'like', '%' . $searchInput . '%')
            ->orWhere('email', 'like', '%' . $searchInput . '%')
            ->orWhere('full_address', 'like', '%' . $searchInput . '%')
            ->orWhere('police_station', 'like', '%' . $searchInput . '%')
            ->orWhere('district', 'like', '%' . $searchInput . '%')
            ->orWhere('division', 'like', '%' . $searchInput . '%')
            ->get();

        return response()->json(['deliverymen' => $deliverymen]);
    }

    public function searchMerchant(Request $request)
    {

        $searchTerm = $request->input('admin_delivery_search');
        $user = User::where('business_name', 'LIKE', "%$searchTerm%")
            ->orWhere('merchant_name', 'LIKE', "%$searchTerm%")
            ->orWhere('pick_up_location', 'LIKE', "%$searchTerm%")
            ->orWhere('phone', 'LIKE', "%$searchTerm%")
            ->orWhere('email', 'LIKE', "%$searchTerm%")
            ->get();
        return response()->json(['user' => $user]);
    }

    public function adminSearch(Request $request)
    {

        $searchTerm = $request->input('admin_delivery_search');
        $deliveries = Admin::where('designation', 'LIKE', "%$searchTerm%")
            ->orWhere('admin_name', 'like', $searchTerm)  // Use '=' for exact match
            ->orWhere('phone', 'LIKE', "%$searchTerm%")
            ->orWhere('email', 'LIKE', "%$searchTerm%")
            ->get();

        return response()->json(['deliveries' => $deliveries]);
    }

    public function calculatorSearch(Request $request)
    {
        $searchTerm = $request->input('admin_delivery_search');

        $results = Deliverycharge::where('id', 'LIKE', "%$searchTerm%")
            ->orWhere('from_location', 'LIKE', "%$searchTerm%")
            ->orWhere('destination', 'LIKE', "%$searchTerm%")
            ->orWhere('category', 'LIKE', "%$searchTerm%")
            ->orWhere('delivery_type', 'LIKE', "%$searchTerm%")
            ->orWhere('cost', 'LIKE', "%$searchTerm%")
            ->orWhere('weight', 'LIKE', "%$searchTerm%")
            ->get();

        return response()->json(['results' => $results]);
    }

    // ******Pickupman controller for admin******
    public function pickupManTable()
    {

        $admin = array();
        if (Session::has('loginId')) {
            $admin = Admin::where('id', '=', Session::get('loginId'))->first();
        }

        $pickupmans = Pickupman::paginate(10);
        return view('server.pages.pickupman-table',  compact('pickupmans', 'admin'));
    }

    public function pickupConfirmation(Request $request)
    {

        $pickup = Pickupman::find($request->id);
        $pickup->is_active = 2;

        $pickup->update();
        return response()->json(['status' => 'success']);
        // return redirect('admin/pickupman');
    }

    public function pickupCancelConfirmation(Request $request)
    {

        $pickup = Pickupman::find($request->id);
        $pickup->is_active = 3;
        $pickup->update();

        // return redirect('admin/pickupman');
        return response()->json(['status' => 'success']);
    }

    public function pickupmanDestroy(Request $request)
    {
        // $pickupman = Pickupman::find($request->id);
        // $profile_path = public_path('pickupmen/profile_images/' . $pickupman->profile_img);
        // $nidfront_path = public_path('pickupmen/nid_images/' . $pickupman->nid_front);
        // $nidback_path = public_path('pickupmen/nid_images/' . $pickupman->nid_back);
        // // dd($profile_path);
        // if (file_exists($profile_path)) {
        //     unlink($profile_path);
        // }
        // if (file_exists($nidfront_path)) {
        //     unlink($nidfront_path);
        // }
        // if (file_exists($nidback_path)) {
        //     unlink($nidback_path);
        // }
        // $pickupman->delete();
        // return redirect('admin/pickupman');
        $pickupman = Pickupman::find($request->id);
        $profile_path = public_path('pickupmen/profile_images/' . $pickupman->profile_img);
        $nidfront_path = public_path('pickupmen/nid_images/' . $pickupman->nid_front);
        $nidback_path = public_path('pickupmen/nid_images/' . $pickupman->nid_back);

        if (file_exists($profile_path)) {
            unlink($profile_path);
        }
        if (file_exists($nidfront_path)) {
            unlink($nidfront_path);
        }
        if (file_exists($nidback_path)) {
            unlink($nidback_path);
        }

        $pickupman->delete();

        // Return a response indicating success
        return response()->json(['status' => 'success']);
    }


    // ******Deliveryman controller for admin******

    public function deliveryManTable()
    {

        $admin = array();
        if (Session::has('loginId')) {
            $admin = Admin::where('id', '=', Session::get('loginId'))->first();
        }

        $deliverymen = Deliveryman::paginate(10);
        return view('server.pages.deliveryman-table',  compact('deliverymen', 'admin'));
    }

    public function deliverymanConfirmation(Request $request)
    {

        $deliveryman = Deliveryman::find($request->id);
        $deliveryman->is_active = 2;

        $deliveryman->update();

        // return redirect('admin/deliveryman');
        return response()->json(['status' => 'success']);
    }

    public function deliverymanCancelConfirmation(Request $request)
    {

        $deliveryman = Deliveryman::find($request->id);
        $deliveryman->is_active = 3;
        $deliveryman->update();

        // return redirect('admin/deliveryman');
        return response()->json(['status' => 'success']);
    }

    public function deliverymanDestroy(Request $request)
    {
        $deliveryman = Deliveryman::find($request->id);
        $profile_path = public_path('deliverymen/profile_images/' . $deliveryman->profile_img);
        $nidfront_path = public_path('deliverymen/nid_images/' . $deliveryman->nid_front);
        $nidback_path = public_path('deliverymen/nid_images/' . $deliveryman->nid_back);
        // dd($profile_path);
        if (file_exists($profile_path)) {
            unlink($profile_path);
        }
        if (file_exists($nidfront_path)) {
            unlink($nidfront_path);
        }
        if (file_exists($nidback_path)) {
            unlink($nidback_path);
        }
        $deliveryman->delete();
        // return redirect('admin/deliveryman');
        

        // Return a response indicating success
        return response()->json(['status' => 'success']);
    }








    // ******Product Controller for Admin******

    public function productTable()
    {

        if (Session::has('loginId')) {
            $admin = Admin::where('id', '=', Session::get('loginId'))->first();
        }
        $deliveries = Product::paginate(10);
        return view('server.pages.delivery-table', compact('deliveries', 'admin'));
    }

    public function productTableAjex(Request $request)
    {
        if (Session::has('loginId')) {
            $admin = Admin::find(Session::get('loginId'));
        }

        // $deliveries = Product::paginate(10);
        // $deliveries = Product::with('user')->paginate(10);
        $deliveries = Product::with(['user', 'pickupman', 'deliveryman'])->paginate(10);
        // $tableContent = view('server.pages.delivery-table', compact('deliveries', 'admin'))->render();

        return response()->json(['deliveries' => $deliveries]);
    }


    public function productEdit(Request $request)
    {

        if (Session::has('loginId')) {
            $admin = Admin::where('id', '=', Session::get('loginId'))->first();
        }
        $delivery = Product::find($request->id);
        return view('server.pages.admin-delivery-edit', compact('delivery', 'admin'));
    }

    public function productUpdate(Request $request)
    {

        $delivery = Product::find($request->up_id);
        $delivery->product_category = $request->deliveryproduct;
        $delivery->customer_name = $request->Customer_name;
        $delivery->customer_phone = $request->phone;
        $delivery->full_address = $request->address;
        $delivery->divisions = $request->divisions;
        $delivery->district = $request->district;
        $delivery->police_station = $request->police;
        $delivery->delivery_type = $request->del;
        $delivery->cod_amount = $request->cod;
        $delivery->invoice = $request->invoice;
        $delivery->note = $request->note;
        $delivery->product_weight = $request->weight;
        $delivery->exchange_status = $request->exchangeparcel;
        $delivery->delivery_charge = $request->deliverycharge;

        $delivery->update();
        // return redirect('admin/product/delivery')->withSuccess('Update successfully.');
        return response()->json([
            'status' => 'success',
        ]);
    }
    public function deliveryChargeupdate(Request $request, Deliverycharge $deliverycharge)
    {

        $delivery = Deliverycharge::find($request->id);
        $delivery->from_location = $request->from_location;
        $delivery->destination = $request->destination;
        $delivery->category = $request->category;
        $delivery->delivery_type = $request->delivery_type;
        $delivery->cost = $request->cost;
        $delivery->update();
        // return redirect('admin/product/delivery')->withSuccess('Update successfully.');
        return response()->json([
            'status' => 'success',
        ]);
    }
    public function productDeliveryConfirmation(Request $request)
    {

        $delivery = Product::find($request->id);
        $delivery->is_active = 3;

        $delivery->update();

        return redirect('admin/product/delivery');
    }

    public function productDeliveryCheckout(Request $request)
    {

        $delivery = Product::find($request->id);
        $delivery->is_active = 4;

        $delivery->update();

        return redirect('admin/product/delivery');
    }

    public function productDeliveryDelivered(Request $request)
    {

        $delivery = Product::find($request->id);
        $delivery->is_active = 4;

        $delivery->update();

        return redirect('admin/product/delivery');
    }


    public function productCancelConfirmation(Request $request)
    {
        $delivery = Product::find($request->id);
        $delivery->is_active = 'cancelled';
        $delivery->update();
        return redirect('admin/product/delivery');
    }

    public function productDestroy(Request $request)
    {

        Product::find($request->id)->delete();
        return redirect('admin/product/delivery');
    }


    // *******Excel File Import & Export*******

    public function productExcelImport(Request $request)
    {

        Excel::Import(new ProductImport, request()->file('excel_file'));
        return redirect('admin/product/delivery')->withSuccess('Excel file import successfully.');
    }

    public function pickupmanExcelImport(Request $request)
    {

        Excel::Import(new PickupmanImport, request()->file('excel_file'));
        return redirect('admin/product/delivery')->withSuccess('Excel file import successfully.');
    }

    public function deliverymanExcelImport(Request $request)
    {

        Excel::Import(new DeliverymanImport, request()->file('excel_file'));
        return redirect('admin/product/delivery')->withSuccess('Excel file import successfully.');
    }

    public function adminExcelImport(Request $request)
    {

        Excel::Import(new AdminImport, request()->file('excel_file'));
        return redirect('admin/product/delivery')->withSuccess('Excel file import successfully.');
    }

    public function productExcelExport()
    {

        return Excel::download(new ProductExport, 'products.xlsx');
        // return redirect('admin/product/delivery')->withSuccess('Excel file download successfully.');

    }

    public function pickupmanExcelExport()
    {
        return Excel::download(new PickupmaExport, 'pickupmen.xlsx');
        // return redirect('admin/product/delivery')->withSuccess('Excel file download successfully.');

    }

    public function deliverymanExcelExport()
    {

        return Excel::download(new DeliverymanExport, 'deliverymen.xlsx');
        // return redirect('admin/product/delivery')->withSuccess('Excel file download successfully.');

    }

    public function adminExcelExport()
    {

        return Excel::download(new AdminExport, 'admins.xlsx');
        // return redirect('admin/product/delivery')->withSuccess('Excel file download successfully.');

    }
}
