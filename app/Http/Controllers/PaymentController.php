<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\PaymentIntent;
use Illuminate\Support\Facades\Auth;
use App\Models\shoppingCart;
use App\Models\Shopping_Cart_Line;
use App\Models\Order;
use App\Models\Order_line;
use App\Models\Product;

use Exception;


class PaymentController extends Controller
{

  public function paymentDetails($id){

    $shoppingCart = shoppingCart::find($id);

    if (Auth::check() && Auth::id() == $shoppingCart->user_id){

      $shoppingCartLines = Shopping_Cart_Line::where('shopping_cart_id',$id)->get();

      $total_price = $shoppingCartLines->sum('total_line_price') + env('GASTOS_ENVIO');

      return view('paymentDetails')
      ->with('shoppingCartId',$id)
      ->with('total_price',$total_price);

  }else{
    return "Not allowed";
  }
  }

  public function deleteShoppingCart($id){

    $shoppingCart = shoppingCart::find($id);

    if (Auth::check() && Auth::id() == $shoppingCart->user_id){
      Shopping_Cart_Line::where('shopping_cart_id', $id)->delete();
      shoppingCart::destroy($id);
      return view('home')->with('success', 'Eliminaste correctamente el carrito');
    }else{
      return "Not allowed";
    }
  }
  public function pay(Request $request){

    try{
    $amount = $request->input('amount');

    $address = $request->input('address');
    $provincia = $request->input('provincia');
    $city = $request->input('city');
    $description = $address." | ".$provincia." | ".$city;

    Stripe::setApiKey(config('services.stripe.secret'));

    $intent = PaymentIntent::create([
      'amount' => $amount*100,
      'currency' => 'eur',
      'payment_method_types' => ['card'],
      'description' => $description
    ]);

    return $intent;
  }catch (Exception $ex){
    return $ex->getMessage();
  }
  }
  public function confirmPay(Request $request) {
    $shoppingCart = shoppingCart::find($request->input('shoppingCartId'));
    if (empty($shoppingCart)){
      return "NOSC";
    }
    try{
    /*Stripe::setApiKey(config('services.stripe.secret'));
    $token = $request->input('token');
    $charge = Charge::create([
       'amount' => $request->input('totalPrice')*100,
       'currency' => 'eur',
       'description' => $request->input('address').' | '.$request->input('city').' | '.$request->input('country'),
       'source' => $token,
     ]);
     */
        $new_order=Order::create([
          'user_id' => Auth::user()->id,
          'send_name' => $request->input('send_name'),
          'send_address'=>$request->input('address'),
          'postal_code'=>$request->input('cp'),
          'country'=>$request->input('country'),
          'provincia'=>$request->input('provincia'),
          'city' =>$request->input('city'),
          'total_price' =>$request->input('totalPrice'),
          'state' => 1,
          'cashOnDelivery' => false
        ]);

        $shoppingCartLines = Shopping_Cart_Line::where('shopping_cart_id',$request->input('shoppingCartId'))->get();

        foreach ($shoppingCartLines as $line) {
          Order_line::create([
              'order_id' => $new_order->id,
              'product_id' => $line->product_id,
              'product_name' =>  $line->product_name,
              'units' =>  $line->units,
              'unit_price' =>  $line->unit_price,
              'total_line_price' =>  $line->total_line_price

          ]);

          //Update product stock
          $product = Product::find($line->product_id);
          $stock=$product->stock - intval($line->units);
          if ($stock<0){
            $stock=0;
          }
          Product::where('id',$line->product_id)->update(['stock' => $stock]);
        }

        Shopping_Cart_Line::where('shopping_cart_id', $request->input('shoppingCartId'))->delete();
        shoppingCart::destroy($request->input('shoppingCartId'));

      return 'success';

    }catch (Exception $ex){

        return "ERROR_DURING_ORDER_CREATION";
    }
}
public function cashOnDelivery(Request $request) {
  $shoppingCart = shoppingCart::find($request->input('shoppingCartId'));
  if (empty($shoppingCart)){
    return "NOSC";
  }
  try{
  /*Stripe::setApiKey(config('services.stripe.secret'));
  $token = $request->input('token');
  $charge = Charge::create([
     'amount' => $request->input('totalPrice')*100,
     'currency' => 'eur',
     'description' => $request->input('address').' | '.$request->input('city').' | '.$request->input('country'),
     'source' => $token,
   ]);
   */
      $new_order=Order::create([
        'user_id' => Auth::user()->id,
        'send_name' => $request->input('send_name'),
        'send_address'=>$request->input('address'),
        'postal_code'=>$request->input('cp'),
        'country'=>$request->input('country'),
        'provincia'=>$request->input('provincia'),
        'city' =>$request->input('city'),
        'total_price' =>$request->input('totalPrice'),
        'state' => 1,
        'cashOnDelivery' => true
      ]);

      $shoppingCartLines = Shopping_Cart_Line::where('shopping_cart_id',$request->input('shoppingCartId'))->get();

      foreach ($shoppingCartLines as $line) {
        Order_line::create([
            'order_id' => $new_order->id,
            'product_id' => $line->product_id,
            'product_name' =>  $line->product_name,
            'units' =>  $line->units,
            'unit_price' =>  $line->unit_price,
            'total_line_price' =>  $line->total_line_price

        ]);

        //Update product stock
        $product = Product::find($line->product_id);
        $stock=$product->stock - intval($line->units);
        if ($stock<0){
          $stock=0;
        }
        Product::where('id',$line->product_id)->update(['stock' => $stock]);
      }

      Shopping_Cart_Line::where('shopping_cart_id', $request->input('shoppingCartId'))->delete();
      shoppingCart::destroy($request->input('shoppingCartId'));

    return 'success';

  }catch (Exception $ex){

      return "ERROR_DURING_ORDER_CREATION";
  }
}



}
