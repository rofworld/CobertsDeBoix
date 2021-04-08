

<body>

<h2 style="text-align:center;">Order {{$order_id}}</h2>
<table style="margin-bottom:40px; width:100%;">
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
     <td><strong>{{$line->product_name}}</strong></td>
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
</body>
<style>
    table,
    caption,
    thead,
    tbody,
    tfoot,
    tr,
    th,
    td {
      border: thin solid transparent;
      font-weight: 200;
      text-align: left;
      vertical-align: middle;
    }
    table {
      background-color: transparent;
      border: 1px solid currentColor;
      border-spacing: 0;
      line-height: 64px;
      margin: 7px 0;
      width: 100%;
    }
    tbody {}
    caption,
    col,
    colgroup,
    thead,
    tfoot {
      background-color: var(--color-translucentwhite);
    }
    td, th {
      border-bottom: 1px solid currentColor;
      padding: 0 15px;
    }
    th {
      background: var(--color-translucentwhite);
      font-weight: bold;
    }


</style>
