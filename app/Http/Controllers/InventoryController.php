<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;

class InventoryController extends Controller
{
    public function create(Request $request){
        $request->validate([
            'name' => 'required|string',
            'quantity' => 'required',
            'price' => 'required',
        ]);
        
        //check to ensure the user trying to perform this function.
        if(\Auth::user()->type == 'Admin'){
            $inventory = new Inventory();

            $inventory->name = $request->name;
            $inventory->quantity = $request->quantity;
            $inventory->price = $request->price;
            
            $inventory->save();

            return response()->json(["data" => $inventory],201);
        }else{
            return response()->json(["Error" => "You are not permitted to perform this action"],401);
        }
    }

    public function show(){
        $inventory = Inventory::paginate(10);

        return response()->json(["data" => $inventory],200);
    }

    public function update($id, Request $request){
        $request->validate([
            'name' => 'required|string',
            'quantity' => 'required',
            'price' => 'required',
        ]);
        
        if(\Auth::user()->type == 'Admin'){
            $inventory = Inventory::findOrFail($id);

            $inventory->name = $request->name;
            $inventory->quantity = $request->quantity;
            $inventory->price = $request->price;
            
            $inventory->save();

            return response()->json(["data" => $inventory],200);
        }else{
            return response()->json(["Error" => "You are not permitted to perform this action"],401);
        }
    }

    public function delete($id){

        if(\Auth::user()->type == 'Admin'){
            $inventory = Inventory::findOrFail($id);
            $inventory->delete();

            return response()->json(["Success" => True],200);
        }
    }
}
