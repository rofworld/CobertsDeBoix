@extends('layouts.app')
<head>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style_links.css') }}">
</head>

@section('content')
<div class="container">
  @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
  @endif
  @if (!empty($links))
  <ul class="list-group">
    @foreach($links as $link)
      <li class="list-group-item">
        {{ $link }}
        <a href="" class="btn btn-dark btn-link-delete">Delete</a>
      </li>
    @endforeach
  </ul>
  <form  method="get" action="{{ route('link.store') }}">

      @csrf

      <div class="form-group">
          <label>New Link:</label>
          <input type="text" class="form-control" name="newlink" id="newlink">


          <input name="artist_id" type="hidden" value= {{ $artist_id }}>
          <input type="submit" name="send" value="Submit" class="btn btn-dark btn-block">

      </div>
      </form>


      @endif


</div>
@endsection
