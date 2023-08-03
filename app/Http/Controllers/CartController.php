<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Inventory;
use App\Models\User;
use Auth;

class CartController extends Controller
{
    public function create(Request $request){
        $request->validate([
            'inventory_id' => 'required',
            'quantity' => 'required',
        ]);

        $user = User::where('id', \Auth::user()->id)->first();
        $inventory = Inventory::where('id', $request->inventory_id)->first();

        //checks for availabity of items in the inventory
        if($request->quantity <= $inventory->quantity){  
            $new_item = new Cart();
            $new_item->inventory_id = $request->inventory_id;
            $new_item->quantity = $request->quantity;
            $new_item->price = $inventory->price * $request->quantity;

            $inventory->quantity =  $inventory->quantity - $request->quantity;

            $new_item->user_id = $user->id;
        
            $new_item->save();
            $inventory->save();

            return response()->json(["data" => $new_item],201);
        }else{
            return response()->json(["error" => "We don't have enough in the inventory"], 400);
        }
        
    }

    //this function shows the items in the cart of the currently logged in user.
    public function show_cart(){
        $cart = Cart::where('user_id', \Auth::user()->id)->paginate(10);

        return response()->json(["data" => $cart],200);
    }
}
