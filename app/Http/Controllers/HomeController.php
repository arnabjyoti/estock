<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemDetals;
use App\Models\Zone;
use App\Models\ItemReceived;
use App\Models\ItemDisbursed;
use Carbon\Carbon;
class HomeController extends Controller
{
    
    // protected $redirectTo = RouteServiceProvider::HOME;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = ItemDetals::get();
        $zone = Zone::get();
        $type = $data->count();
        $count = $data->sum('quantity');
        $itemRecCount = ItemReceived::whereDate('created_at',  Carbon::today()->toDateString())->get()->count();
        $itemDecCount = ItemDisbursed::whereDate('created_at',  Carbon::today()->toDateString())->get()->count();
        $itemExpiredCount = ItemReceived::whereRaw('DATEDIFF(CURRENT_DATE(), receivedDate) = warranty')->get()->count();

        return view('home',compact('data','zone','count','itemRecCount','itemDecCount','type','itemExpiredCount'));
    }

    public function expiryReport()
    {
        $itemExpired = ItemReceived::whereRaw('DATEDIFF(CURRENT_DATE(), receivedDate) = warranty')->get();
        return view ('ExpiredReport',compact('itemExpired'));
    }
}
