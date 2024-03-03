<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers\Marchant;

use App\Http\Controllers\Controller;
use App\Models\Deliveryman;
use Carbon\Carbon;


class AllConsignmentController extends Controller
{
    public function all_consignment()
    {

            $allConsignment = Deliveryman::all();
            return view('marchant.pages.all_consignment', compact('allConsignment'));

    }
    public function list_byDate()
    {

            $result = Deliveryman::selectRaw('date(created_at) as date, count(*) as total_products')
                ->groupBy('date')
                ->get();
            return view('marchant.pages.list_by_date_allConsignment', compact('result'));

    }
    public function pending_consignment()
    {
            $activeData = Deliveryman::where('is_active', 2)->get();
            return view('marchant.pages.pending_consignment', compact('activeData'));

    }
    public function approval_pending_consignment()
    {
            $activeData = Deliveryman::where('is_active', 1)->get();
            return view('marchant.pages.approval_pending_consignment', compact('activeData'));

    }
    public function delivery_consignment()
    {

            $activeData = Deliveryman::where('is_active', 4)->get();
            return view('marchant.pages.delivered_consignment', compact('activeData'));

    }
    public function partly_delivery_consignment()
    {

            $activeData = Deliveryman::where('is_active', 3)->get();
            return view('marchant.pages.partly_delivered', compact('activeData'));

    }
    public function cancel_consignment()
    {

            $activeData = Deliveryman::where('is_active', 'cancelled')->get();
            return view('marchant.pages.cancel_consignment', compact('activeData'));

    }
    public function inreview_consignment()
    {

            return view('marchant.pages.inreview_consignment');

    }
    public function latest_entries_consignment()
    {

            $today = Carbon::today();
            $tomorrow = Carbon::tomorrow();
            $formattedToday = $today->toDateString();
            $formattedTomorrow = $tomorrow->toDateString();
            $activeData = Deliveryman::whereBetween('created_at', [$formattedToday, $formattedTomorrow])->get();
            $total = Deliveryman::whereBetween('created_at', [$formattedToday, $formattedTomorrow])->count();
            $cod_amount = Deliveryman::whereBetween('created_at', [$formattedToday, $formattedTomorrow])->sum('cod_amount');
            return view('marchant.pages.latest_entries', compact('activeData', 'total', 'cod_amount'));
    }
    public function pick_n_drop_consignment()
    {

            $activeData = Deliveryman::where('delivery_type', 'Pickup & Drop')->get();
            return view('marchant.pages.pick_n_drop_consignment', compact('activeData'));

    }
}
