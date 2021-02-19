@extends('layouts.app')


@section('content')
<div class="container">

  @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
  @endif

<form  method="post" action="{{ route('product.store') }}" enctype="multipart/form-data">

    @csrf

    <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control {{ $errors->has('name') ? 'error' : '' }}" name="name" id="name">

        <!-- Error -->
        @if ($errors->has('name'))
        <div class="error">
            {{ $errors->first('name') }}
        </div>
        @endif
    </div>

    <div class="form-group">
        <label>Description</label>
        <textarea class="form-control {{ $errors->has('description') ? 'error' : '' }}" name="description" id="description" rows="6">
        </textarea>
        @if ($errors->has('description'))
        <div class="error">
            {{ $errors->first('description') }}
        </div>
        @endif
    </div>

    <div class="form-group">
        <label>Stock</label>
        <input type="text" class="form-control {{ $errors->has('stock') ? 'error' : '' }}" name="stock" id="stock">

        <!-- Error -->
        @if ($errors->has('stock'))
        <div class="error">
            {{ $errors->first('stock') }}
        </div>
        @endif
    </div>

    <div class="form-group">
        <label>Price (In Euros)</label>
        <input type="text" class="form-control {{ $errors->has('price') ? 'error' : '' }}" name="price" id="price">

        <!-- Error -->
        @if ($errors->has('price'))
        <div class="error">
            {{ $errors->first('price') }}
        </div>
        @endif
    </div>


    <div class="form-group">

      @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
          @endif
          <label>Choose Image File:</label>
          <input type="file" id="file" name="file" style="display: none;" />
          <input type="button" value="Browse..." onclick="document.getElementById('file').click();" />
    </div>



    <input type="submit" name="send" value="Submit" class="button-dark btn-block">
</form>
</div>
@endsection
