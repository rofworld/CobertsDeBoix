<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\shoppingCart;
use App\Models\Shopping_Cart_Line;

class shoppingCartController extends Controller
{
  public function viewShop(Request $request){
    $products = Product::where('hidden',false)->get();
    $shoppingCarts =null;
    if (Auth::check()) {
      $shoppingCarts = shoppingCart::where('user_id',Auth::user()->id)->get();
    }
    $shoppingCartLines =null;
    $total_products = null;

    if (Auth::check() && !$shoppingCarts->isEmpty()){

      $shopping_cart_id = $shoppingCarts[0]->id;
      $shoppingCartLines = Shopping_Cart_Line::where('shopping_cart_id',$shopping_cart_id)->get();
      $total_products = $shoppingCartLines->sum('units');
    }
    return view('online_shop')
    ->with('product_list',$products)
    ->with('shoppingCarts',$shoppingCarts)
    ->with('total_products',$total_products);

  }

  public function viewProduct($id){

    $product=Product::where('id', $id)->first();
    $shoppingCarts =null;
    if (Auth::check()) {
      $shoppingCarts = shoppingCart::where('user_id',Auth::user()->id)->get();
    }
    $shoppingCartLines =null;
    $total_products = null;

    if (Auth::check() && !$shoppingCarts->isEmpty()){

      $shopping_cart_id = $shoppingCarts[0]->id;
      $shoppingCartLines = Shopping_Cart_Line::where('shopping_cart_id',$shopping_cart_id)->get();
      $total_products = $shoppingCartLines->sum('units');
    }

    return view('product_view')
    ->with('product',$product)
    ->with('shoppingCarts',$shoppingCarts)
    ->with('total_products',$total_products);

  }

  public function viewCart($id){
    if (Auth::check()) {
        $shoppingCart = shoppingCart::where('id',$id)->get();
        if (!$shoppingCart->isEmpty() && $shoppingCart[0]->user_id == Auth::user()->id){
          $shoppingCartLines = Shopping_Cart_Line::where('shopping_cart_id',$id)->get();
          $total_price = $shoppingCartLines->sum('total_line_price');
          return view('shopping_cart')
          ->with('shoppingCartLines',$shoppingCartLines)
          ->with('total_price',$total_price);
        }else{
            return "Not allowed";
        }
    }else{
        return redirect()->guest('/login');
    }
  }


  public function addToCart(Request $request){

    if (Auth::check()) {

          $shoppingCarts = shoppingCart::where('user_id',Auth::user()->id)->get();
          $product=Product::where('id', $request->input('id'))->first();


          if ($shoppingCarts->isEmpty()){

            if ($request->input('stock_units') > $product->stock){
              return "NOSTOCK";
            }

            $new_shoppingCart=shoppingCart::create([
              'user_id' => Auth::user()->id
            ]);



            Shopping_Cart_Line::create([
                'shopping_cart_id' => $new_shoppingCart->id,
                'product_id' => $request->input('id'),
                'product_name' => $product->name,
                'units' => $request->input('stock_units'),
                'unit_price' => $product->price,
                'total_line_price' => $product->price * $request->input('stock_units')


            ]);

            return "The new shopping Cart ID is ".$new_shoppingCart->id;
          }else{

            $shopping_cart_stock=Shopping_Cart_Line::where('shopping_cart_id',$shoppingCarts[0]->id)->get()->sum('units');

            if ($request->input('stock_units') + $shopping_cart_stock  > $product->stock){
              return "NOSTOCK";
            }

            Shopping_Cart_Line::create([
                'shopping_cart_id' => $shoppingCarts[0]->id,
                'product_id' => $request->input('id'),
                'product_name' => $product->name,
                'units' => $request->input('stock_units'),
                'unit_price' => $product->price,
                'total_line_price' => $product->price * $request->input('stock_units')


            ]);


            return "There is an existing shopping Cart";
          }


    }else{
      return "NOLIN";
    }

  }
}
