$('#markAsCompleteButton').click(function () {
  /* find id */
  var checked = []
  $(".sentCheck:checked").each(function ()
  {
      checked.push(parseInt($(this).val()));
  });

  console.log(checked);
  var params = {
    ordersArray: checked
  };
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  request = $.ajax({
    url: "/list_orders/markAsComplete",
    type: "POST",
    data: params
  }); // Callback handler that will be called on success

  request.done(function (response, textStatus, jqXHR) {
    // Log a message to the console
    //console.log(response);
    //console.log(textStatus); //push array

      location.reload();

  });
  request.fail(function (jqXHR, textStatus, errorThrown) {
    // Log the error to the console
    console.error("The following error occurred: " + textStatus, errorThrown);
  });


});
$('#markAsRefusedButton').click(function () {
  /* find id */
  var checked = []
  $(".sentCheck:checked").each(function ()
  {
      checked.push(parseInt($(this).val()));
  });

  console.log(checked);
  var params = {
    ordersArray: checked
  };
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  request = $.ajax({
    url: "/list_orders/markAsRefused",
    type: "POST",
    data: params
  }); // Callback handler that will be called on success

  request.done(function (response, textStatus, jqXHR) {
    // Log a message to the console
    //console.log(response);
    //console.log(textStatus); //push array

      location.reload();

  });
  request.fail(function (jqXHR, textStatus, errorThrown) {
    // Log the error to the console
    console.error("The following error occurred: " + textStatus, errorThrown);
  });


});
