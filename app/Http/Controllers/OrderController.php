<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('backend.order')->with('orders',$orders);
    }
    public function approve($id){
        $orders = Order::findOrFail($id);
        $orders->status = 1; //Approved
        $orders->save();
        return redirect()->back(); //Redirect user somewhere
    }
     public function reject($id){
        $orders = Order::findOrFail($id);
        $orders->status = 0; //Declined
        $orders->save();
        return redirect()->back(); //Redirect user somewhere
    }
}