<?php

namespace App\Http\Controllers\Deliveryman;

use App\Http\Controllers\Controller;
use App\Models\Deliveryman;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class DeliveryManController extends Controller
{
    public function index()
    {

        $deliveryman = array();
        if (Session::has('loginId')) {
            $deliveryman = Deliveryman::where('id', '=', Session::get('loginId'))->first();
        }
        return view('deliveryman-dashboard', compact('deliveryman'));
    }

    public function create()
    {

        $deliveryman = array();
        if (Session::has('loginId')) {
            $deliveryman = Deliveryman::where('id', '=', Session::get('loginId'))->first();
        }
        return view('deliveryman.auth.registration', compact('deliveryman'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'deliveryman_name' => 'required',
            'phone' => 'required',
            'alt_phone' => 'required',
            'email' => 'required',
            'password' => 'required|min:8|confirmed',
            'full_address' => 'required',
            'police_station' => 'required',
            'district' => 'required',
            'division' => 'required',
            'nid_front' => 'required',
            'nid_back' => 'required',
            'profile_img' => 'required',
        ]);

        $deliveryman = new Deliveryman;
        $deliveryman->deliveryman_name = $request->deliveryman_name;
        $deliveryman->phone = $request->phone;
        $deliveryman->alt_phone = $request->alt_phone;
        $deliveryman->email = $request->email;
        $deliveryman->password = Hash::make($request->password);
        $deliveryman->full_address = $request->full_address;
        $deliveryman->police_station = $request->police_station;
        $deliveryman->district = $request->district;
        $deliveryman->division = $request->division;

        if ($request->hasFile('profile_img')) {
            $file = $request->file('profile_img');
            $filename = $deliveryman->deliveryman_name . '_' . $request->profile_img->getClientOriginalName();
            $file->move('deliverymen/profile_images/', $filename);
            $deliveryman->profile_img = $filename;
        }

        if ($request->hasFile('nid_front')) {
            $file = $request->file('nid_front');
            $filename = $deliveryman->deliveryman_name . '_' . $request->nid_front->getClientOriginalName();
            $file->move('deliverymen/nid_images/', $filename);
            $deliveryman->nid_front = $filename;
        }

        if ($request->hasFile('nid_back')) {
            $file = $request->file('nid_back');
            $filename = $deliveryman->deliveryman_name . '_' . $request->nid_back->getClientOriginalName();
            $file->move('deliverymen/nid_images/', $filename);
            $deliveryman->nid_back = $filename;
        }

        $deliveryman->save();

        return redirect('deliveryman/register')->withSuccess('Your Registration completed.');
    }

    public function loginView()
    {

        return view('deliveryman.auth.login');
    }

    function loginCheck(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $deliveryman = Deliveryman::where('email', '=', $request->email)->first();
        if ($deliveryman) {
            if (Hash::check($request->password, $deliveryman->password)) {
                $request->session()->put('loginId', $deliveryman->id);
                return redirect('deliveryman/dashboard');
            } else if ($request->password == $deliveryman->password) {
                $request->session()->put('loginId', $deliveryman->id);
                return redirect('deliveryman/dashboard');
            } else {

                return back()->with('fail', 'Login details are not valid');
            }
        } else {
            return back()->with('fail', 'Login details are not valid');
        }
    }

    function logout()
    {

        if (Session::has('loginId')) {
            Session::pull('loginId');
            return redirect('deliveryman/login');
        }
    }

    public function edit(Request $request)
    {

        $id = Session::get('loginId');
        $deliveryman = Deliveryman::where('id', '=', $id)->first();
        return view('deliveryman.auth.deliveryman-update', ['deliveryman' => $deliveryman]);
    }


    public function deliverymanUpdate(Request $request)
    {
        $deliveryman = Deliveryman::find($request->id);
        $deliveryman->deliveryman_name = $request->deliveryman_name;
        $deliveryman->phone = $request->phone;
        $deliveryman->alt_phone = $request->alt_phone;
        $deliveryman->email = $request->email;
        $deliveryman->full_address = $request->full_address;
        $deliveryman->police_station = $request->police_station;
        $deliveryman->district = $request->district;
        $deliveryman->division = $request->division;
        if ($request->hasFile('profile_img')) {
            $destination = public_path('deliverymen/profile_images/' . $deliveryman->deliveryman_name . '_' . $request->oldimage);
            // dd($destination);
            if (file_exists($destination)) {
                unlink($destination);
            }
            $file = $request->file('profile_img');
            $filename = $deliveryman->deliveryman_name . '_' . $request->profile_img->getClientOriginalName();
            $file->move('deliverymen/profile_images/', $filename);
            $deliveryman->profile_img = $filename;
        }

        if ($request->hasFile('nid_front')) {
            $destination = public_path('deliverymen/nid_images/' . $deliveryman->deliveryman_name . '_' . $request->oldimage);
            // dd($destination);
            if (file_exists($destination)) {
                unlink($destination);
            }
            $file = $request->file('nid_front');
            $filename = $deliveryman->deliveryman_name . '_' . $request->nid_front->getClientOriginalName();
            $file->move('deliverymen/nid_images/', $filename);
            $deliveryman->nid_front = $filename;
        }

        if ($request->hasFile('nid_back')) {
            $destination = public_path('deliverymen/nid_images/' . $deliveryman->deliveryman_name . '_' . $request->oldimage);
            // dd($destination);
            if (file_exists($destination)) {
                unlink($destination);
            }
            $file = $request->file('nid_back');
            $filename = $deliveryman->deliveryman_name . '_' . $request->nid_back->getClientOriginalName();
            $file->move('deliverymen/nid_images/', $filename);
            $deliveryman->nid_back = $filename;
        }

        $deliveryman->update();
        return redirect('deliveryman/edit')->withSuccess('Update successfully.');
    }

    function changePassword()
    {

        $deliveryman = array();
        if (Session::has('loginId')) {
            $deliveryman = Deliveryman::where('id', '=', Session::get('loginId'))->first();
        }

        return view('deliveryman.auth.deliveryman-change-password', compact('deliveryman'));
    }

    function updatePassword(Request $request)
    {

        $request->validate([
            'old_password' => 'required',
            'password' => 'required',

        ]);

        $id = Session::get('loginId');

        $deliveryman = Deliveryman::where('id', '=', $id)->first();
        if (Hash::check($request->old_password, $deliveryman->password)) {
            $deliveryman->password = Hash::make($request->password);
            $deliveryman->update();

            return redirect('deliveryman/change/password')->withSuccess('Update successfully.');
        } else {

            return redirect('deliveryman/change/password')->withSuccess('Old Password Does not Match.');
        };
    }

    public function deliverymanDelete(Request $request)
    {

        $deliveryman = array();
        if (Session::has('loginId')) {
            $deliveryman = Deliveryman::where('id', '=', Session::get('loginId'))->first();
        }

        return view('deliveryman.auth.deliveryman-account-delete', compact('deliveryman'));
    }

    public function deliverymanDeleteAccount(Request $request)
    {

        $request->validate([
            'password' => 'required',

        ]);

        $id = Session::get('loginId');

        $deliveryman = Deliveryman::where('id', '=', $id)->first();
        if (Hash::check($request->password, $deliveryman->password)) {
            $deliveryman->delete();
            return redirect('deliveryman/register');
        } else {
            return redirect('deliveryman/delete')->withSuccess('Invalid Password.');
        };
    }

    public function productTable()
    {

        $deliveryman = array();
        if (Session::has('loginId')) {
            $deliveryman = Deliveryman::where('id', '=', Session::get('loginId'))->first();
        }
        // $id = Auth::id();

        $products = Product::paginate(10);
        return view('deliveryman.pages.product-table', compact('products', 'deliveryman'));
    }

    public function productDeliveryDelivered(Request $request)
    {

        $delivery = Product::find($request->id);
        $delivery->is_active = 5;

        $id = Session::get('loginId');
        // dd($id);
        $delivery->deliveryman_id = $id;

        $delivery->update();

        return redirect('deliveryman/product/table');
    }

    public function productDeliveryReturn(Request $request)
    {
        $delivery = Product::find($request->id);
        $delivery->is_active = 6;

        $id = Session::get('loginId');
        // dd($id);
        $delivery->deliveryman_id = $id;

        $delivery->update();

        return redirect('deliveryman/product/table');
    }
    public function productDeliveryCancel(Request $request)
    {

        $delivery = Product::find($request->id);
        $delivery->is_active = 7;

        $id = Session::get('loginId');
        // dd($id);
        $delivery->deliveryman_id = $id;

        $delivery->update();

        return redirect('deliveryman/product/table');
    }

    public function searcDeliverymanProductTable(Request $request)
    {
        $search = $request->input('admin_delivery_search');

        $customers = Product::with(['user:id,merchant_name'])
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
            ->get();

        return response()->json(['customers' => $customers]);
    }
}
