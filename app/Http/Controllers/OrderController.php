<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Order_line;

class OrderController extends Controller
{
  public function list(){
  if (Auth::check() && Auth::user()->admin == true){
    $orders = Order::where('sent',false)->get();
    return view('listOrders')
    ->with('orders',$orders);
  }else{
    return "Not allowed";
  }

  }

  public function viewOrder($id){

    $order = Order::where('id',$id)->first();
    if (Auth::check() && (Auth::user()->admin==true)){

      $order_lines = Order_line::where('order_id',$id)->get();
      return view('viewOrder')
      ->with('order_lines',$order_lines)
      ->with('order_id',$id)
      ->with('send_name',$order->send_name)
      ->with('send_address',$order->send_address)
      ->with('postal_code',$order->postal_code)
      ->with('city',$order->city)
      ->with('provincia',$order->provincia)
      ->with('country',$order->country);
    }else{
      return "Not allowed";
    }

  }

  public function markAsSent(Request $request){

    foreach ($request->input('ordersArray') as $orderId) {

      $order = Order::find($orderId);

      $order->sent = true;

      $order->save();


    }

    return "success";

  }
}
