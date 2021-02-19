@extends('layouts.app')

<head>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/shopping_cart_style.css') }}">
</head>

@section('content')

<div class="container">



    <h3><u>Shopping Cart</u></h3>
    <table class="shopping_cart_table">
       ​<thead>
      	<tr>
      	  <th>Product</th>
      	  <th>Unit Price</th>
      	  <th>Quantity</th>
      	  <th>Line Price</th>
      	</tr>
       ​</thead>
       ​<tbody>
       @foreach ($shoppingCartLines as $line)

       <tr>
         <td>{{$line->product_name}}</td>
         <td>{{$line->unit_price}}</td>
         <td>{{$line->units}}</td>
         <td>{{$line->total_line_price}}</td>
       </tr>
       @endforeach
     </tbody>
    </table>
    </div>
    <div>
      <label class="total_price pull-right">Total price: {{$total_price}} €</label>
    </div>
    <hr>
    <div>
  		<em><a id="checkoutButton" title="Checkout Button" href="{{ url('/checkout/'.$line->shopping_cart_id)}}">Checkout ({{ $total_price }} €)</a></em>
    </div>




</div>
@endsection
