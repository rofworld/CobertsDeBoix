@extends('layouts.app')
<head>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/style_register.css') }}"/>
</head>


@section('content')
<div class="container">

                    <form method="POST" action="{{ route('login') }}">
                        @csrf


                            <div>
                                <label for="email" class="form-control">{{ __('E-Mail Address') }}</label>
                            </div>
                            <div>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            </div>
                                @error('email')
                                <div>
                                        <div class="invalid-feedback"><p>{{ $message }}</p></div>
                                </div>
                                @enderror




                              <div>
                                <label for="password" class="form-control">{{ __('Password') }}</label>
                              </div>

                              <div>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                              </div>
                                @error('password')
                                <div>

                                        <div class="invalid-feedback"><p>{{ $message }}</p></div>

                                </div>
                                @enderror




                        @if (Route::has('password.request'))
                        <div class="forgot-password">
                            <a href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        </div>
                        @endif
                                <div>
                                <button type="submit" class="btn-submit">
                                    {{ __('Login') }}
                                </button>
                                </div>



                    </form>
                </div>
@endsection
