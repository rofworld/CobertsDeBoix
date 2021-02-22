
  $("#btn-submit").click(function(){
    var l1 = $("#send_name").val().length;
    var l2 = $("#send_address").val().length;
    var l3 = $("#cp").val().length;
    var l4 = $("#country").val().length;
    var l5 = $("#provincia").val().length;
    var l6 =$("#city").val().length;
    var l7 = $('#ccn').val().length;
    var l8 = $('#cvc').val().length;
    var l9 = $('#expiry_month').val().length;
    var l10 = $('#expiry_year').val().length;

    if ( (l1!=0) && (l2!=0) && (l3!=0) && (l4!=0) && (l5!=0) && (l6!=0) && (l7!=0) && (l8!=0) && (l9!=0) && (l10!=0) ){
      var stripe = Stripe("pk_test_51IGkTPAy4FlKjV1rR8rdRHaAxJsSSPprkfsJuByNTPqIXwsh14QQW4FfZ6ftiXiNeCcvz2KC3P4Hoj4SnXGnPtyg002DjH39FE");
      var ccn = $('#ccn').val();
      var cvc = $('#cvc').val();
      var expiry_month = $('#expiry_month').val();
      var expiry_year = $('#expiry_year').val();
      Stripe.setPublishableKey("pk_test_51IMHwrCxHijM4K66s7lRb1tHoL9NBRIkJ55UCDinQk5MInOpM8c39RmvpW5DqCVnNU8acpcsOiCVFTIJ9uUhQENV00i14JSKoo");
      Stripe.card.createToken({
          number: ccn,
          cvc: cvc,
          exp_month: parseInt(expiry_month),
          exp_year: parseInt(expiry_year)
        }, stripeHandleResponse);
      }else{
        $('#status').append('<div class="alert alert-danger">' + "Fill all parameters" + '</div>');
        window.scrollTo(0,0);
      }
  });

  function stripeHandleResponse(status, response) {
          if (response.error) {
                  console.log("Create Token Error");
                  $('#status').append('<div class="alert alert-danger">' + "Create Token Error" + '</div>');
                  window.scrollTo(0,0);
          } else {
              var token = response['id'];
              var shoppingCartId=parseInt($("#shoppingCartId").val());
              var totalPrice = $("#total_price").val();
              var send_name =  $("#send_name").val()
              var address = $("#send_address").val();
              var cp = $("#cp").val();
              var country = $("#country").val();
              var provincia = $("#provincia").val();
              var city =$("#city").val();
              console.log(shoppingCartId);
              var params = {
                token: token,
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
                url: "pay",
                type: "POST",
                data: params
              }); // Callback handler that will be called on success

              request.done(function (response, textStatus, jqXHR) {

                if (response=="NOSC"){
                  console.log(response);
                  console.log(textStatus); //push array
                  console.log("Payment Done");
                  $('#status').append('<div class="alert alert-danger">' + "No Shopping Cart" + '</div>');
                  window.scrollTo(0,0);

                }else{
                  // Log a message to the console
                  console.log(response);
                  console.log(textStatus); //push array
                  console.log("Payment Done");
                  $('#status').append('<div class="alert alert-success">' + "Payment Done" + '</div>');
                  window.scrollTo(0,0);
              }
              });
              request.fail(function (jqXHR, textStatus, errorThrown) {
                // Log the error to the console
                console.error("The following error occurred: " + textStatus, errorThrown);
                $('#status').append('<div class="alert alert-danger">' + "Error during payment" + '</div>');
                window.scrollTo(0,0);
              });

          }
      }
