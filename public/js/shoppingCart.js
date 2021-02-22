$('#deleteButton').click(function () {
  /* find id */

  var numberOfChecked = $('.deleteCheck:checked').length;
  var totalCheckboxes = $('.deleteCheck').length;
  var all=0;
  if (numberOfChecked == totalCheckboxes){
    all= 1;
  }
  var checked = []
  $(".deleteCheck:checked").each(function ()
  {
      checked.push(parseInt($(this).val()));
  });

  console.log(checked);
  var params = {
    all: all,
    itemsArray: checked
  };
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  request = $.ajax({
    url: "/shoppingCart/delete",
    type: "POST",
    data: params
  }); // Callback handler that will be called on success

  request.done(function (response, textStatus, jqXHR) {
    // Log a message to the console
    //console.log(response);
    //console.log(textStatus); //push arra
    location.reload();


  });
  request.fail(function (jqXHR, textStatus, errorThrown) {
    // Log the error to the console
    console.error("The following error occurred: " + textStatus, errorThrown);
  });


});
