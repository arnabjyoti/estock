<?php

namespace App\Http\Controllers;
use \Exception;
use DB;
use Illuminate\Http\Request;
use App\Models\ItemDetals;
use App\Models\ItemReceived;
use App\Models\ItemDisbursed;

class ItemAddingController extends Controller
{

    // protected $redirectTo = RouteServiceProvider::HOME;


    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function datasubmit(Request  $req)
    {
        $req->validate([
            'newItem' => 'required',
        ]);
        $data = new ItemDetals;
        $existingItem = $data::where('itemname', '=', $req->newItem)->first();
        if(!$existingItem){
            $data->itemname = $req->newItem;
            $data->quantity = 0;
            $data->save();
            return "ok";
        }
        return "Already Exist";
    }

    public function AddItemForm()
    {
        return view("addItem");
    }

    public function AddReceivedItem(Request  $req)
    {
        $req->validate([
            'quantity' => 'required',
            'itemSelected' =>'required',
            'quantity' => 'required',
            'recDate' => 'required',
            'warranty' => 'required'

        ]);
        try {
        $recItem = new ItemReceived;
        $recItem->itemnamme = $req->itemSelected;
        $recItem->quantity = $req->quantity;
        $recItem->receivedDate = $req->recDate;
        $recItem->warranty = $req->warranty;
        if($recItem->save())  
        {
            $existingItem = ItemDetals::where('itemname', '=', $req->itemSelected)->first();
            if($existingItem){
                $existingItem->quantity = $existingItem->quantity + $req->quantity;
                if($existingItem->save())
                    return "ok";
            }
            return "Item entered inn received item table but not in Item details";   
        }
        }
        catch(Exception $e){
            return $e;
        }
    }

    public function AddDisbursedItem(Request $req)
    {
        $req->validate([
            'quantity' => 'required',
            'itemSelected' =>'required',
            'zone' => 'required',
            'roadName' => 'required',
            'decDate' => 'required'
        ]);
       
        try
        {
        $decItem = new ItemDisbursed;
        $decItem->itemnam = $req->itemSelected;
        $decItem->quantity = $req->quantity;
        $decItem->roadName = $req->roadName;
        $decItem->zoneName = $req->zone;
        $decItem->disbursedDate = $req->decDate;
       
        if($decItem->save())  
        {
            $existingItem = ItemDetals::where('itemname', '=', $req->itemSelected)->first();
            if($existingItem->quantity >= $req->quantity){
                $existingItem->quantity = $existingItem->quantity - $req->quantity;
                if($existingItem->save())
                    return "ok";
            }
            else{
                return "QLTQ";
            }
            return "Item entered inn received item table but not in Item detzils";   
        }
        }
        catch(Exception $e){
            return $e;
        }
          
    }

    public function DeleteItem(Request $req)
    {
        $existingItem = ItemDetals::where('itemname', '=', $req->itemToBeDeleted)->delete();
        if($existingItem)
            return "Ok";
        else 
            return "error";
    }

    public function DeleteDisItem(Request $req)
    {
        $existingItem = ItemDisbursed::where('id', '=', $req->itemToBeDeleted)->delete();
        if($existingItem)
            return "Ok";
        else 
            return "error";
    }

    public function DeleteRecItem(Request $req)
    {
        $existingItem = ItemReceived::where('id', '=', $req->itemToBeDeleted)->delete();
        if($existingItem)
            return "Ok";
        else 
            return "error";
    }
}
