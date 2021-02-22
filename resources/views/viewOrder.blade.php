@extends('layouts.app')


@section('content')

<div class="container">



    <h3><u>Order {{$order_id}}</u></h3>
    <table style="margin-bottom:40px;">
       ​<thead>
      	<tr>
           <th>Product</th>
      	   <th>Quantity</th>
           <th>Unit Price</th>
      	   <th>Total Price</th>

      	</tr>
       ​</thead>
       ​<tbody>
       @foreach ($order_lines as $line)

       <tr>
         <td><strong><a href="/product_view/{{$line->product_id}}">{{$line->product_name}}</a></strong></td>
         <td><strong>{{$line->units}}</strong></td>
         <td><strong>{{$line->unit_price}}</strong></td>
         <td><strong>{{$line->total_line_price}}</strong></td>
       </tr>
       @endforeach
     </tbody>
    </table>
    <label style="font-size: 24px; font-weight:bold;">Datos de envio</label>
    <div style="margin-top: 20px; border:1px solid  var(--color-boix-dark); padding:20px;">
      <div>
        <label><strong>Nombre Completo: </strong></label>

        <label>{{$send_name}}</label>
      </div>
      <div>
        <label><strong>Direccion: </strong></label>

        <label>{{$send_address}}</label>
      </div>
      <div>
        <label><strong>Codigo postal: </strong></label>

        <label>{{$postal_code}}</label>
      </div>
      <div>
        <label><strong>Ciudad: </strong></label>

        <label>{{$city}}</label>
      </div>
      <div>
        <label><strong>Provincia: </strong></label>

        <label>{{$provincia}}</label>
      </div>
      <div>
        <label><strong>Pais: </strong></label>

        <label>{{$country}}</label>
      </div>
    </div>




@endsection
