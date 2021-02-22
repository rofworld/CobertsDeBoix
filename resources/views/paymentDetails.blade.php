@extends('layouts.app')

<head>
  @if ((new \Jenssegers\Agent\Agent())->isDesktop())
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style_payment.css') }}"/>
  @else
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style_payment_mobile.css') }}"/>
  @endif
  <script src="https://js.stripe.com/v2/"></script>
</head>



@section('content')
<div class="container">
<div id="status">
</div>
  <h3 style="margin-left:15%;"><u>Payment Details</u></h3>
  <div class="payment-details">
                        <input id="shoppingCartId" type="text" value="{{$shoppingCartId}}" hidden>
                        <input id="total_price" type="text" value="{{$total_price}}" hidden>
                        <label style="margin-left:15%;">Datos de envio</label>
                        <div id="form-send-data">
                        <div class="form-group">
                          <div>
                                <label for="name" class="form-control">{{ __('Nombre Completo') }}</label>
                          </div>
                          <div>
                                <input id="send_name" type="text" class="form-control" required>
                          </div>

                        </div>

                        <div class="form-group">
                            <div>
                                <label for="address" class="form-control">{{ __('Direccion de Envio') }}</label>
                            </div>
                            <div>
                                <input id="send_address" type="text" class="form-control" required>
                            </div>

                        </div>

                        <div class="form-group">
                              <div>
                                <label for="cp" class="form-control">{{ __('Codigo Postal') }}</label>
                              </div>

                              <div>
                                <input id="cp" type="text" class="form-control" required>
                              </div>

                        </div>
                        <div class="form-group">
                              <div>
                                <label for="city" class="form-control">{{ __('Ciudad') }}</label>
                              </div>
                              <div>
                                <input id="city" type="text" class="form-control" required>
                              </div>

                        </div>


                        <div class="form-group">
                              <div>
                                <label for="provincia" class="form-control">{{ __('Provincia') }}</label>
                              </div>
                              <div>
                                <input id="provincia" type="text" class="form-control" required>
                              </div>

                        </div>

                        <div class="form-group">

                            <div>
                                <label for="country" class="form-control">{{ __('Pais') }}</label>
                            </div>

                            <div>
                                <input id="country" type="text" class="form-control" required>
                            </div>

                        </div>
                      </div>
                      <label style="margin-left:15%;">Datos de pago</label>
                      <div id="form-payment-data">
                        <div class="form-group">
                          <div>
                          <label for="ccn" class="form-control">Credit Card Number:</label>
                          </div>
                          <div>
                          <input id="ccn" class="form-control-ccn" type="text" maxlength="19" placeholder="xxxxxxxxxxxxxxxx" required>
                          </div>
                        </div>
                        <div class="form-group">
                          <div>
                          <label for="expiry_month" class="form-control">{{ __('Expiry Month') }}</label>
                          </div>
                          <div>
                          <input id="expiry_month" class="form-control-expiry-month" type="text" required>
                          </div>
                        </div>
                        <div class="form-group">
                          <div>
                          <label for="expiry_year" class="form-control">{{ __('Expiry Year') }}</label>
                          </div>
                          <div>
                          <input id="expiry_year" class="form-control-expiry-year" type="text" required>
                          </div>
                        </div>
                        <div class="form-group">
                          <div>
                          <label for="cvc" class="form-control">{{ __('CVC') }}</label>
                          </div>
                          <div>
                          <input id="cvc" class="form-control-cvc" type="text" required>
                          </div>
                        </div>
                      </div>
                      <em><button id="btn-submit" class="btn-submit">
                                    Pay ( {{$total_price}} € )
                      </button></em>

  <script src="{{ asset('js/client.js') }}" type="text/javascript"></script>

  </div>
</div>
@endsection
