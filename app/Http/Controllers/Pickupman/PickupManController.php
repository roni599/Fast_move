<?php

namespace App\Http\Controllers\Pickupman;

use App\Http\Controllers\Controller;
use App\Models\Pickupman;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class PickupManController extends Controller
{
    public function index()
    {
        try {
            $pickupman = array();
            if (Session::has('loginId')) {
                $pickupman = Pickupman::where('id', '=', Session::get('loginId'))->first();
            }
            return view('pickupman-dashboard', compact('pickupman'));
        } catch (\Throwable $th) {
            return view('marchant.pages.404');
        }
    }

    public function create()
    {
        try {
            $pickupman = array();
            if (Session::has('loginId')) {
                $pickupman = Pickupman::where('id', '=', Session::get('loginId'))->first();
            }
            return view('pickupman.auth.registration', compact('pickupman'));
        } catch (\Throwable $th) {
            return view('marchant.pages.404');
        }
    }

    public function store(Request $request)
    {
            $request->validate([
                'pickupman_name' => 'required',
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

            $pickupman = new Pickupman;
            $pickupman->pickupman_name = $request->pickupman_name;
            $pickupman->phone = $request->phone;
            $pickupman->alt_phone = $request->alt_phone;
            $pickupman->email = $request->email;
            $pickupman->password = Hash::make($request->password);
            $pickupman->full_address = $request->full_address;
            $pickupman->police_station = $request->police_station;
            $pickupman->district = $request->district;
            $pickupman->division = $request->division;

            if($request->hasFile('profile_img')){
                $file = $request->file('profile_img');
                $filename = $pickupman->pickupman_name.'_'. $request->profile_img->getClientOriginalName();
                $file->move('pickupmen/profile_images/', $filename);
                $pickupman->profile_img = $filename;
            }

            if($request->hasFile('nid_front')){
                $file = $request->file('nid_front');
                $filename = $pickupman->pickupman_name.'_'. $request->nid_front->getClientOriginalName();
                $file->move('pickupmen/nid_images/', $filename);
                $pickupman->nid_front = $filename;
            }

            if($request->hasFile('nid_back')){
                $file = $request->file('nid_back');
                $filename = $pickupman->pickupman_name.'_'. $request->nid_back->getClientOriginalName();
                $file->move('pickupmen/nid_images/', $filename);
                $pickupman->nid_back = $filename;
            }

            $pickupman->save();

            return redirect('pickupman/register')->withSuccess('Your Registration completed.');
    }

    public function loginView()
    {
        try {
            return view('pickupman.auth.login');
        } catch (\Throwable $th) {
            return view('marchant.pages.404');
        }
    }

    function loginCheck(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required',
                'password' => 'required'
            ]);

            $pickupman = Pickupman::where('email', '=', $request->email)->where('is_active', '=', 2)->first();
            if ($pickupman) {
                if (Hash::check($request->password, $pickupman->password)) {
                    $request->session()->put('loginId', $pickupman->id);
                    return redirect('pickupman/dashboard');
                } else if ($request->password == $pickupman->password) {
                    $request->session()->put('loginId', $pickupman->id);
                    return redirect('pickupman/dashboard');
                } else {

                    return back()->with('fail', 'Login details are not valid');
                }
            } else {
                return back()->with('fail', 'Login details are not valid');
            }
        } catch (\Throwable $th) {
            return view('marchant.pages.404');
        }
    }

    function logout()
    {
        try {
            if (Session::has('loginId')) {
                Session::pull('loginId');
                return redirect('pickupman/login');
            }
        } catch (\Throwable $th) {
            return view('marchant.pages.404');
        }
    }

    public function edit(Request $request)
    {
        try {
            $id = Session::get('loginId');
            $pickupman = Pickupman::where('id', '=', $id)->first();
            return view('pickupman.auth.pickupman-update', ['pickupman' => $pickupman]);
        } catch (\Throwable $th) {
            return view('marchant.pages.404');
        }
    }


    public function pickupmanUpdate(Request $request)
    {
                $pickupman = Pickupman::find($request->id);
                $pickupman->pickupman_name = $request->pickupman_name;
                $pickupman->phone = $request->phone;
                $pickupman->alt_phone = $request->alt_phone;
                $pickupman->email = $request->email;
                $pickupman->full_address = $request->full_address;
                $pickupman->police_station = $request->police_station;
                $pickupman->district = $request->district;
                $pickupman->division = $request->division;
                if($request->hasFile('profile_img')){
                    $destination = public_path('pickupmen/profile_images/' . $pickupman->pickupman_name .'_'. $request->oldimage);
                    // dd($destination);
                    if(file_exists($destination))
                    {
                        unlink($destination);
                    }
                    $file = $request->file('profile_img');
                    $filename = $pickupman->pickupman_name.'_'. $request->profile_img->getClientOriginalName();
                    $file->move('pickupmen/profile_images/', $filename);
                    $pickupman->profile_img = $filename;
                }

                if($request->hasFile('nid_front')){
                    $destination = public_path('pickupmen/nid_images/' . $pickupman->pickupman_name .'_'. $request->oldimage);
                    // dd($destination);
                    if(file_exists($destination))
                    {
                        unlink($destination);
                    }
                    $file = $request->file('nid_front');
                    $filename = $pickupman->pickupman_name.'_'. $request->nid_front->getClientOriginalName();
                    $file->move('pickupmen/nid_images/', $filename);
                    $pickupman->nid_front = $filename;
                }

                if($request->hasFile('nid_back')){
                    $destination = public_path('pickupmen/nid_images/' . $pickupman->pickupman_name .'_'. $request->oldimage);
                    // dd($destination);
                    if(file_exists($destination))
                    {
                        unlink($destination);
                    }
                    $file = $request->file('nid_back');
                    $filename = $pickupman->pickupman_name.'_'. $request->nid_back->getClientOriginalName();
                    $file->move('pickupmen/nid_images/', $filename);
                    $pickupman->nid_back = $filename;
                }

                $pickupman->update();
                return redirect('pickupman/edit')->withSuccess('Update successfully.');
    }

    function changePassword()
    {
        try {
            $pickupman = array();
            if (Session::has('loginId')) {
                $pickupman = Pickupman::where('id', '=', Session::get('loginId'))->first();
            }

            return view('pickupman.auth.pickupman-change-password', compact('pickupman'));
        } catch (\Throwable $th) {
            return view('marchant.pages.404');
        }
    }

    function updatePassword(Request $request)
    {
        try {
                $request->validate([
                    'old_password' => 'required',
                    'password' => 'required',

                ]);

                $id = Session::get('loginId');

                $pickupman = Pickupman::where('id', '=', $id)->first();
                if (Hash::check($request->old_password, $pickupman->password)) {
                    $pickupman->password = Hash::make($request->password);
                    $pickupman->update();

                    return redirect('pickupman/change/password')->withSuccess('Update successfully.');
                } else {

                    return redirect('pickupman/change/password')->withSuccess('Old Password Does not Match.');
                };
        } catch (\Throwable $th) {
            return view('marchant.pages.404');
        }
    }

    public function pickupmanDelete(Request $request)
    {
        try {
                $pickupman = array();
                if (Session::has('loginId')) {
                    $pickupman = Pickupman::where('id', '=', Session::get('loginId'))->first();
                }

                return view('pickupman.auth.pickupman-account-delete', compact('pickupman'));
        } catch (\Throwable $th) {
            return view('marchant.pages.404');
        }
    }

    public function pickupmanDeleteAccount(Request $request)
    {
        try {
                $request->validate([
                    'password' => 'required',

                ]);

                $id = Session::get('loginId');

                $pickupman = Pickupman::where('id', '=', $id)->first();
                if (Hash::check($request->password, $pickupman->password)) {
                    $pickupman->delete();
                    return redirect('pickupman/register');
                } else {
                    return redirect('pickupman/delete')->withSuccess('Invalid Password.');
                };
        } catch (\Throwable $th) {
            return view('marchant.pages.404');
        }
    }

    public function productTable()
    {
        try {
                $pickupman = array();
                if (Session::has('loginId')) {
                    $pickupman = Pickupman::where('id', '=', Session::get('loginId'))->first();
                }
                // $id = Auth::id();

                $products = Product::paginate(10);
                return view('pickupman.pages.product-table', compact('products', 'pickupman'));
        } catch (\Throwable $th) {
            return view('marchant.pages.404');
        }
    }

    public function productDeliveryConfirmation(Request $request)
    {

        try {
                $delivery = Product::find($request->id);
                $delivery->is_active = 2;

                $id = Session::get('loginId');
                // dd($id);
                $delivery->pickupman_id = $id;

                $delivery->update();

                return redirect('pickupman/product/table');
        } catch (\Throwable $th) {
            return view('marchant.pages.404');
        }
    }

}
