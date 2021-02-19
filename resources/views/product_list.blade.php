@extends('layouts.app')
<head>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/style_product_list.css') }}">

</head>

@section('content')
<div class="container">
  @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
  @endif
  @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif


    <div class="table">
    @foreach ($product_list as $product)
		<article>
			<h3>{{$product->name}} {{$product->price}}€</h3>
			<strong>{{$product->description}}</strong>
			<div><img src="storage/{{ $product->image_url }}" alt="Picture 1"></div>
		</article>

    <div id="product_list_buttons" class="product_list_buttons">
      <em><a href="{{ url('/product/hide/'. $product->id) }}">
        {{$product->hidden ? 'Hidden' : 'Hide' }}
      </a></em>

      <em><a href="{{ url('/product_edit_form/'. $product->id) }}">Edit</a></em>
      <em><label for="modal-one-{{$product->id}}" class="stock_button">Stock {{$product->stock}}</label></em>
      <div>
	       <input id="modal-one-{{$product->id}}" type="checkbox" hidden>
	        <dialog>
		          <header>
			             <h3>Stock</h3>
		          </header>

                  <form  method="post" action="{{ route('product.changeStock') }}">

                  @csrf

                  <div class="form-group">
                      <label>New Stock</label>
                      <input type="text" class="form-control {{ $errors->has('stock') ? 'error' : '' }}" name="stock" id="stock">
                      <!-- Error -->
                      @if ($errors->has('stock'))
                      <div class="error">
                          {{ $errors->first('stock') }}
                      </div>
                      @endif
                      <input type="hidden" class="form-control" name="id" id="id" value="{{$product->id}}">
                  </div>
                  <input type="submit" name="send" value="Submit" class="button-dark btn-block">
                </form>
                  <nav>
              			<label for="modal-one-{{$product->id}}">Close</label>
              		</nav>
	           </dialog>
      </div>

    </div>
	   <hr>

     @endforeach
</div>
</div>
</div>

</div>
@endsection
