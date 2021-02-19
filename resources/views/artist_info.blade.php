@extends('layouts.app')
<head>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style_artist.css') }}">
</head>


@section('content')
<div class="container">
  @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
  @endif
  @if(session()->has('warning'))
    <div class="alert alert-warning">
        {{ session()->get('warning') }}
    </div>
  @endif
<div class="simple">
  @foreach ($artist_info_list as $artist)
  	<article>
  		<h3>{{$artist->name}}</h3>
  		<div><img src="storage/{{ $artist->image_url }}">{{$artist->description}}</div>

      <details>
        <summary>Links</summary>
          <ul>
            @foreach($map_artist_links[$artist->id] as $link)
          	 <li><a href="{{ $link }}">{{ $link }}</a></li>
            @endforeach
          </ul>
    </details>

      <div id="artist_admin_buttons" class="artist_admin_buttons">
        <em><a href="{{ url('/artist_info/delete/'. $artist->id) }}" class="btn">Delete</a></em>
        <em><a href="{{ url('/links/list/'. $artist->id) }}" class="btn">Links</a></em>
      </div>
    </article>

  	<hr>
  @endforeach
</div>
@endsection
