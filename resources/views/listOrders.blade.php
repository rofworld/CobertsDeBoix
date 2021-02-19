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

       <tr>
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



      <em><label for="modal-one" class="pull-right buttons">Mark as Sent</label></em>
      <div>
	       <input id="modal-one" type="checkbox" hidden>
	        <dialog>
		          <header>
			             <h3>Alert</h3>
                   <label>Are you sure you want to mark those orders as sent?</label>
		          </header>



                  <em><button id="markAsSentButton" class="button-dark btn-block">Mark as Sent</button></em>
                  <nav>
              			<label for="modal-one">Close</label>
              		</nav>
	           </dialog>
      </div>

    <script src="{{ asset('js/orders.js') }}" type="text/javascript"></script>
    </div>

@endsection
