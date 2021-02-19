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

                        <div class="form-group row">
                              <div>
                                <label for="address" class="form-control">{{ __('Direccion') }}</label>
                              </div>

                              <div>
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required>
                              </div>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                        </div>

                        <div class="form-group row">
                            <div>
                                <label for="postal_code" class="form-control">{{ __('Codigo Postal') }}</label>
                            </div>
                            <div>
                                <input id="postal_code" type="text" class="form-control @error('postal_code') is-invalid @enderror" name="postal_code" value="{{ old('postal_code') }}" required>
                            </div>
                                @error('postal_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                        </div>

                        <div class="form-group row">
                              <div>
                                <label for="provincia" class="form-control">{{ __('Provincia') }}</label>
                              </div>
                              <div>
                                <input id="provincia" type="text" class="form-control @error('provincia') is-invalid @enderror" name="provincia" value="{{ old('provincia') }}" required>
                              </div>
                                @error('provincia')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                        </div>

                        <div class="form-group row">

                            <div>
                                <label for="country" class="form-control">{{ __('Pais') }}</label>
                            </div>

                            <div>
                                <input id="country" type="text" class="form-control @error('country') is-invalid @enderror" name="country" value="{{ old('country') }}" required>
                            </div>
                                @error('country')
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
