<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\ItemDetals;
use App\Models\Zone;
use App\Models\ItemReceived;
use App\Models\ItemDisbursed;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    // protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = ItemDetals::get();
        $zone = Zone::get();
        return view('ItemDetails',compact('data','zone'));
    }

    public function ReceivedItems(){
        $data = ItemDetals::get();
        $zone = Zone::get();
        return view('ItemRecieved',compact('data','zone'));
    }

    public function DisbursedItems(){
        $data = ItemDetals::get();
        $zone = Zone::get();
        return view('ItemDisburesd',compact('data','zone'));
    }

    public function ItemDisbursedForm(){
        $data = ItemDetals::get();
        $zone = Zone::get();
        return view("itemDisbursedForm",compact('data','zone'));
    }

    public function ItemReceievedForm(){
        $data = ItemDetals::get();
        return view("ItemReceivedForm", compact('data'));
    }

    public function ItemReceivedReport(Request $req)
    {
        $searchedItem= $req->rptType;
        $fromDate = $req->fromDate;
        $toDate = $req->toDate;
        if(!$searchedItem && !$fromDate && !$toDate)
        {
            $query = ItemReceived::get();
            $count = $query->count();
        }
        else if(!$fromDate && !$toDate)
        {
            $query = ItemReceived::where("itemnamme", $searchedItem)->get();
            $count = $query->count();
        }

        //need to change the logic for date and name of the items.
        else if(!$searchedItem)
        {
            $query = ItemReceived::whereBetween("receivedDate", [$fromDate, $toDate])->get();
            $count = $query->count();
        }
        else
        {
            $query = ItemReceived::whereBetween("receivedDate", [$fromDate, $toDate])->where("itemnamme", $searchedItem)->get();
            $count = $query->count();
        }
        $data = ItemDetals::get();
        $zone = Zone::get();
        return view ('ReceivedReport', compact('data','zone', 'query','count'));
    }

    public function ItemDisbursedReport(Request $req)
    {
        $searchedItem= $req->rptType;
        $fromDate = $req->fromDate;
        $toDate = $req->toDate;
        if(!$searchedItem && !$fromDate && !$toDate){
            $query = ItemDisbursed::get();
            $count = $query->count();
        }
        else if(!$fromDate && !$toDate){
            $query = ItemDisbursed::where("itemnam", $searchedItem)->get();
            $count = $query->count();
        }
        else if(!$searchedItem)
        {
            $query = ItemDisbursed::whereBetween("disbursedDate", [$fromDate, $toDate])->get();
            $count = $query->count();
        }
        else
        {
            $query = ItemDisbursed::whereBetween("disbursedDate", [$fromDate, $toDate])->where("itemnam", $searchedItem)->get();
            $count = $query->count();
        }
        $data = ItemDetals::get();
        $zone = Zone::get();
        return view ('DisbursedReport', compact('query','data','zone','count'));
    }
}
