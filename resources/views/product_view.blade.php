@extends('layouts.app')
<head>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/product_view_style.css') }}">

</head>

@section('content')

<div class="container">
  <div id="status">
  </div>
  <section>
	<header>
		<h3><u>{{$product->name}} {{$product->price}} €</u></h3>
	</header>

	<div>
    <div class="flex-grid-2">
    	<section class="panel"><img src="{{url('storage/'.$product->image_url)}}"></section>
    	<section class="panel"><p>{{$product->description}}</p></section>
    </div>
	</div>
  <div id="GastosDeEnvio">
    <p>Los envios se hacen por toda España. Los gastos de envio son {{env('GASTOS_ENVIO')}} €.
    El plazo de entrega son 15 dias naturales.</p>
  </div>
  <footer>
    <div class="form-group form-group-stock">
      <em><button class="plus_button" id ="less_button" title="Stock unit control" >-</button></em>
        <em><label id="stock_units" class="stock_input_label">1</label></em>
      <em><button class="plus_button" id="plus_button" title="Stock unit control" >+</button></em>
      <label hidden id="product_id">{{ $product->id }}</label>
    </div>
    <div class="form-group">
  		<em><button id="addToCartButton" title="Add to Cart Button" class="addToCartButton">Add to Cart</button></em>
    </div>
    @if (Auth::check() && !$shoppingCarts->isEmpty())
      <div class="form-group">
    		<em><a class="viewCartButton" href="{{ url('/shoppingCart/'.$shoppingCarts[0]->id)}}">View Shopping Cart ( {{$total_products}} )</a></em>
      </div>
    @endif
  <script src="{{ asset('js/product_view_logic.js') }}" type="text/javascript"></script>
	</footer>


</section>

</div>
@endsection
