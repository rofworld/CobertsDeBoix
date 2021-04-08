@extends('layouts.app')

<head>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/shopping_cart_style.css') }}">
</head>

@section('content')

<div class="container">
  @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
  @endif
        <div class="table">
       @foreach ($shoppingCartLines as $line)

      <article>
        <h3>{{$line->product_name}} X {{$line->units}} </h3>
        <strong>{{$map_description[$line->id]}}. Precio: {{$line->unit_price}} X {{$line->units}} = {{$line->total_line_price}} € </strong>
        <div><img src="/storage/{{ $map_images[$line->id]}}" alt="{{$line->product_name}}"></div>
      </article>

       @endforeach
     </div>

    <div class="sub-total-price">
      <label style="font-size:24px; font-weight: bold; font-family: Courier" >SubTotal: {{$subtotal_price}} €</label>
    </div>

    <div class="gastos-envio">
      <label style="font-size:24px; font-weight: bold; font-family: Courier" >Gastos de envio: {{env('GASTOS_ENVIO')}} €</label>
    </div>

    <div class="total-price">
      <label style="font-size:35px; font-weight: bold; font-family: Courier">Total: {{$subtotal_price + env('GASTOS_ENVIO') }} €</label>
    </div>
    <hr>
    <div>
      <em><a id="deleteButton" title="Borrar Carrito" href="{{ url('/delete_shopping_cart/'.$line->shopping_cart_id)}}">Borrar Carrito</a></em>
  		<em><a id="checkoutButton" title="Checkout Button" href="{{ url('/checkout/'.$line->shopping_cart_id)}}">Comprar ({{ $subtotal_price + env('GASTOS_ENVIO') }} €)</a></em>

    </div>
    <script src="{{ asset('js/shoppingCart.js') }}" type="text/javascript"></script>



</div>
@endsection
