<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Order_line;
use App;

class OrderController extends Controller
{
  const ORDEN_EN_CURSO = 1;
  const ORDEN_COMPLETADA = 2;
  const ORDEN_RECHAZADA = 3;

  public function list(){
  if (Auth::check() && Auth::user()->admin == true){
    $orders = Order::where('state',self::ORDEN_EN_CURSO)->get();
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

  public function markAsComplete(Request $request){

    foreach ($request->input('ordersArray') as $orderId) {

      $order = Order::find($orderId);

      $order->state = self::ORDEN_COMPLETADA;

      $order->save();


    }

    return "success";

  }
  public function markAsRefused(Request $request){

    foreach ($request->input('ordersArray') as $orderId) {

      $order = Order::find($orderId);

      $order->state = self::ORDEN_RECHAZADA;

      $order->save();


    }

    return "success";

  }

  public function printToPdf($id){

    $order = Order::where('id',$id)->first();

    if (Auth::check() && (Auth::user()->admin==true)){
      $order_lines = Order_line::where('order_id',$id)->get();
      $data = [
        'order_lines' => $order_lines,
        'order_id' => $id,
        'send_name' => $order->send_name,
        'send_address' => $order->send_address,
        'postal_code' => $order->postal_code,
        'city' => $order->city,
        'provincia' => $order->provincia,
        'country' => $order->country
      ];

      $pdf = App::make('dompdf.wrapper');
      $pdf->loadView('pdf.orderPdf',$data);

      return $pdf->download('pedido_'.$id.'.pdf');
    }else{
      return "Not allowed";
    }
  }
}
