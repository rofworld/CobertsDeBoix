@extends('layouts.app')

<head>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/style_register.css') }}"/>
</head>



@section('content')
<div class="container">
  <div class="register-form">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group">
                          <div>
                                <label for="name" class="form-control">{{ __('Nombre Completo') }}</label>
                          </div>
                          <div>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                          </div>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                        </div>

                        <div class="form-group row">
                            <div>
                                <label for="email" class="form-control">{{ __('Direccion Email') }}</label>
                            </div>
                            <div>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            </div>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                        </div>

                      

                        <div class="form-group">

                            <div>
                                <label for="password" class="form-control">{{ __('Password') }}</label>
                            </div>

                            <div>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                        </div>

                        <div class="form-group">
                            <div>
                              <label for="password-confirm" class="form-control">{{ __('Confirm Password') }}</label>
                            </div>
                            <div>
                              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>


                      <button type="submit" class="btn-submit">
                                    {{ __('Register') }}
                      </button>
    </form>
  </div>
</div>
@endsection
