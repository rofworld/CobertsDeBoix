var stripe = Stripe("pk_test_51IMHwrCxHijM4K66s7lRb1tHoL9NBRIkJ55UCDinQk5MInOpM8c39RmvpW5DqCVnNU8acpcsOiCVFTIJ9uUhQENV00i14JSKoo");
var elements = stripe.elements();
var card = elements.create('card', {
  'style': {
    'base': {
      'fontFamily': 'Cursive , Helvetica, Arial, sans-serif',
      'fontSize': '20px',
      'color': 'black'
    },
    'invalid': {
      'color': 'red',
    }
  }
});

// Add an instance of the card UI component into the `card-element` <div>
card.mount('#card-element');


$("#btn-submit").click(function(){
  var l1 = $("#send_name").val().length;
  var l2 = $("#send_address").val().length;
  var l3 = $("#cp").val().length;
  var l4 = $("#country").val().length;
  var l5 = $("#provincia").val().length;
  var l6 =$("#city").val().length;
  var checkbox_val = $("#politica-checkbox").prop("checked");
  console.log(checkbox_val);
  if ( (l1!=0) && (l2!=0) && (l3!=0) && (l4!=0) && (l5!=0) && (l6!=0) ){
  if (checkbox_val == true){
        if ($("input:radio[id='em-pago-online']").is(':checked')){
          console.log("Pagando Online...");
          payOnline();
        }else if ($("input:radio[id='em-pago-rembolso']").is(':checked')){
          console.log("Pagando Contra Rembolso...");
          cashOnDelivery();
        }else{
          console.log("Por favor seleccione una forma de pago");
          $('#status').empty();
          $('#status').append('<div class="alert alert-danger">' + "Seleccione una forma de pago" + '</div>');
          window.scrollTo(0,0);
        }
    }else{
      $('#status').empty();
      $('#status').append('<div class="alert alert-danger">' + "Acepte la politica de provicidad" + '</div>');
      window.scrollTo(0,0);
    }
    }else{
      $('#status').empty();
      $('#status').append('<div class="alert alert-danger">' + "Datos de envio/pago incompletos" + '</div>');
      window.scrollTo(0,0);
    }
});

  function payOnline(){

      /*stripe.createToken(card).then(function(result) {
        if (result.error) {
          // Inform the user if there was an error
          var errorElement = document.getElementById('card-errors');
          errorElement.textContent = result.error.message;
        } else {
          // Send the token to your server
          console.log(result.token);
          stripeTokenHandler(result.token);
        }
      });*/
      var totalPrice = $("#total_price").val();
      var address = $("#send_address").val();
      var provincia = $("#provincia").val();
      var city =$("#city").val();

      var params = {
        amount:totalPrice,
        address:address,
        provincia:provincia,
        city:city
      };
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      request = $.ajax({
        url: "pay",
        type: "POST",
        data: params
      }); // Callback handler that will be called on success

      request.done(function (response, textStatus, jqXHR) {

        console.log(response);
        stripe.confirmCardPayment(response.client_secret, {
          payment_method: {
            card: card,
            /*billing_details: {
              name: 'Jenny Rosen',
            },*/
          },
        }).then(function(result) {
          // Handle result.error or result.paymentIntent
          console.log(result);
          if (result.error){
            $('#status').empty();
            $('#status').append('<div class="alert alert-danger">' + "Error durante el pago" + '</div>');
            window.scrollTo(0,0);
          }else{
            confirmPaymentHandler(result.paymentIntent);
          }

        });

        });

  }

  function confirmPaymentHandler(paymentIntent) {

              var shoppingCartId=parseInt($("#shoppingCartId").val());
              var totalPrice = $("#total_price").val();
              var send_name =  $("#send_name").val()
              var address = $("#send_address").val();
              var cp = $("#cp").val();
              var country = $("#country").val();
              var provincia = $("#provincia").val();
              var city =$("#city").val();

              var params = {

                shoppingCartId:shoppingCartId,
                send_name: send_name,
                address:address,
                cp:cp,
                country:country,
                provincia:provincia,
                city:city,
                totalPrice:totalPrice
              };
              $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });
              request = $.ajax({
                url: "confirmPay",
                type: "POST",
                data: params
              }); // Callback handler that will be called on success

              request.done(function (response, textStatus, jqXHR) {

                if (response=="NOSC"){
                  console.log(response);
                  console.log(textStatus); //push array
                  $('#status').empty();
                  $('#status').append('<div class="alert alert-danger">' + "Carrito inexistante" + '</div>');
                  window.scrollTo(0,0);

                }else if (response=="ERROR_DURING_ORDER_CREATION"){
                  // Log a message to the console
                  console.log(response);
                  console.log(textStatus); //push array
                  console.log("ERROR_DURING_ORDER_CREATION Done");
                  $('#status').empty();
                  $('#status').append('<div class="alert alert-success">' + "Error durante el pago" + '</div>');
                  window.scrollTo(0,0);
                }else{
                  // Log a message to the console
                  console.log(response);
                  console.log(textStatus); //push array
                  console.log("Payment Done");
                  $('#status').empty();
                  $('#status').append('<div class="alert alert-success">' + "Pago realizado correctamente" + '</div>');
                  window.scrollTo(0,0);
              }
              });
              request.fail(function (jqXHR, textStatus, errorThrown) {
                // Log the error to the console
                console.error("The following error occurred: " + textStatus, errorThrown);
                $('#status').append('<div class="alert alert-danger">' + "Error durante el pago" + '</div>');
                window.scrollTo(0,0);
              });


      }

function cashOnDelivery(){

  var shoppingCartId=parseInt($("#shoppingCartId").val());
  var totalPrice = $("#total_price").val();
  var send_name =  $("#send_name").val()
  var address = $("#send_address").val();
  var cp = $("#cp").val();
  var country = $("#country").val();
  var provincia = $("#provincia").val();
  var city =$("#city").val();

  var params = {

    shoppingCartId:shoppingCartId,
    send_name: send_name,
    address:address,
    cp:cp,
    country:country,
    provincia:provincia,
    city:city,
    totalPrice:totalPrice
  };
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  request = $.ajax({
    url: "cashOnDelivery",
    type: "POST",
    data: params
  }); // Callback handler that will be called on success

  request.done(function (response, textStatus, jqXHR) {

    if (response=="NOSC"){
      console.log(response);
      console.log(textStatus); //push array
      $('#status').empty();
      $('#status').append('<div class="alert alert-danger">' + "Carrito inexistante" + '</div>');
      window.scrollTo(0,0);

    }else if (response=="ERROR_DURING_ORDER_CREATION"){
      // Log a message to the console
      console.log(response);
      console.log(textStatus); //push array
      console.log("ERROR_DURING_ORDER_CREATION Done");
      $('#status').empty();
      $('#status').append('<div class="alert alert-success">' + "Error durante el pago" + '</div>');
      window.scrollTo(0,0);
    }else{
      // Log a message to the console
      console.log(response);
      console.log(textStatus); //push array
      console.log("Payment Done");
      $('#status').empty();
      $('#status').append('<div class="alert alert-success">' + "Recibirá su pedido contra rembolso en un plazo de 5 a 7 dias naturales" + '</div>');
      window.scrollTo(0,0);
  }
  });
  request.fail(function (jqXHR, textStatus, errorThrown) {
    // Log the error to the console
    console.error("The following error occurred: " + textStatus, errorThrown);
    $('#status').append('<div class="alert alert-danger">' + "Error durante el pago" + '</div>');
    window.scrollTo(0,0);
  });

}


$("input:radio[name='forma-de-pago']").click(function () {

          if ($("input[id='em-pago-online']").is(':checked')) {
              $("#info-contra-rembolso").hide();
              $("#form-payment-data").show();
          }
          if ($("input[id='em-pago-rembolso']").is(':checked')) {
              $("#info-contra-rembolso").show();
              $("#form-payment-data").hide();
          }
});
