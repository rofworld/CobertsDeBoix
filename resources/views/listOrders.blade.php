@extends('layouts.app')

<head>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/list_orders_style.css') }}">
</head>

@section('content')

<div class="container">



    <h3><u>Orders</u></h3>
    <table>
       ​<thead>
      	<tr>
           <th>Select</th>
      	  <th>Order Id</th>
          <th>Date</th>
      	  <th>Address</th>
          <th>City</th>
      	  <th>Total price</th>

      	</tr>
       ​</thead>
       ​<tbody>
       @foreach ($orders as $order)

       <tr style="background-color: {{$order->cashOnDelivery ? 'var(--color-blue)' : ''}}">
          <td>
          <input id="checkbox-{{$order->id}}" class="sentCheck" name="some" type="checkbox" value="{{$order->id}}">
          </td>
          <td><strong><a href="/orders/view/{{$order->id}}">Order {{$order->id}}</a></strong></td>
         <td><strong>{{$order->created_at}}</strong></td>
         <td><strong>{{$order->send_address}}</strong></td>
         <td><strong>{{$order->city}}</strong></td>
         <td><strong>{{$order->total_price}}</strong></td>
       </tr>
       @endforeach
     </tbody>
    </table>



      <em><label for="modal-one" class="pull-right buttons">Marcar como Completado</label></em>
      <div>
	       <input id="modal-one" type="checkbox" hidden>
	        <dialog>
		          <header>
			             <h3>Alerta</h3>
                   <label>Seguro que quieres marcar estos pedidos como completados?</label>
		          </header>



                  <em><button id="markAsCompleteButton" class="button-dark btn-block">Completar</button></em>
                  <nav>
              			<label for="modal-one">Close</label>
              		</nav>
	           </dialog>
      </div>
      <em><label for="modal-two" class="pull-right buttons" style="margin-right:20px;">Marcar como Rechazado</label></em>
      <div>
	       <input id="modal-two" type="checkbox" hidden>
	        <dialog>
		          <header>
			             <h3>Alerta</h3>
                   <label>Seguro que quieres marcar estos pedidos como rechazados?</label>
		          </header>



                  <em><button id="markAsRefusedButton" class="button-dark btn-block">Rechazar</button></em>
                  <nav>
              			<label for="modal-two">Close</label>
              		</nav>
	           </dialog>
      </div>

    <script src="{{ asset('js/orders.js') }}" type="text/javascript"></script>
    </div>

@endsection
