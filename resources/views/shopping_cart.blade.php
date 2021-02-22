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
          <th>Select</th>
      	  <th>Product</th>
          @if ((new \Jenssegers\Agent\Agent())->isDesktop())
      	  <th>Unit Price</th>
      	  <th>Quantity</th>
      	  <th>Line Price</th>
          @endif
      	</tr>
       ​</thead>
       ​<tbody>
       @foreach ($shoppingCartLines as $line)

       <tr>
         <td>
           <input id="checkbox-{{$line->id}}" class="deleteCheck" name="some" type="checkbox" value="{{$line->id}}">
         </td>
         <td>{{$line->product_name}}</td>
         @if ((new \Jenssegers\Agent\Agent())->isDesktop())
         <td>{{$line->unit_price}}</td>
         <td>{{$line->units}}</td>
         <td>{{$line->total_line_price}}</td>
         @endif
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
      <em><a id="deleteButton" title="Delete Button">Delete Item</a></em>
  		<em><a id="checkoutButton" title="Checkout Button" href="{{ url('/checkout/'.$line->shopping_cart_id)}}">Checkout ({{ $total_price }} €)</a></em>

    </div>
    <script src="{{ asset('js/shoppingCart.js') }}" type="text/javascript"></script>



</div>
@endsection
