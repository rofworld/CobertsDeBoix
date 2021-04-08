@extends('layouts.app')

<head>
  @if ((new \Jenssegers\Agent\Agent())->isDesktop())
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style_payment.css') }}"/>
  @else
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style_payment_mobile.css') }}"/>
  @endif
  <script src="https://js.stripe.com/v3/"></script>
</head>



@section('content')
<div class="container">
<div id="status">
</div>
  <h3 style="margin-left:15%;"><u>Datos de pago</u></h3>
  <div class="payment-details">
                        <input id="shoppingCartId" type="text" value="{{$shoppingCartId}}" hidden>
                        <input id="total_price" type="text" value="{{$total_price}}" hidden>
                        <label id="datos-envio-label">Datos de envio</label>
                        <div id="form-send-data">
                        <div class="form-group">
                          <div>
                                <label for="name" class="form-control">{{ __('Nombre y Apellidos') }}</label>
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
                                <label for="city" class="form-control">{{ __('Municipio') }}</label>
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

                      <label id="datos-pago-label">Datos de pago</label>
                      <div id="forma-de-pago">
                        <strong><input id="em-pago-online" name="forma-de-pago" value="pago-online" type="radio"><label for="em-pago-online">Pago Online</label></strong>
                        <strong><input id="em-pago-rembolso" name="forma-de-pago" value="rembolso" type="radio"><label for="em-pago-rembolso">Pagar contra rembolso</label></strong>
                      </div>
                      <div id="info-contra-rembolso" hidden>
                        El pedido llegará a su direccion en un plazo de entre 5 y 7 dias
                      </div>
                      <div id="form-payment-data" hidden>

                      <label for="card-element">
                        Tarjeta de credito o debito
                      </label>
                      <div id="card-element" style="margin-top:10px;">
                        <!-- a Stripe Element will be inserted here. -->
                      </div>

                      <!-- Used to display form errors -->
                      <div id="card-errors" role="alert"></div>
                      </div>
                      <label id="politica-privacidad-label">Politica de privacidad</label>
                      <div id="form-politica-privacidad">
                        <strong><input id="politica-checkbox" name="politica-checkbox" type="checkbox"><label for="politica-checkbox">Aceptar politica de privacidad</label></strong>
                      </div>
                      <em><button id="btn-submit" class="btn-submit">
                                    Pagar ( {{$total_price}} € )
                      </button></em>

  <script src="{{ asset('js/client.js') }}" type="text/javascript"></script>
  </div>
</div>
@endsection
