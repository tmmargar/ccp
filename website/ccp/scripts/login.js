//$("form").listenForChange();
$(document).ready(function() {
  // use delay to pick up auto complete population so button is enabled
  setTimeout(function(){input.validateLength($("#username"), 1, true);}, 500); // 1/2 second
  setTimeout(function(){input.validateLength($("#password"), 1, false);}, 500); // 1/2 second
  setTimeout(function(){inputLocal.enableLogin();}, 500); // 1/2 second
  inputLocal.setDefaults();
});
var inputLocal = {
  enableLogin : function() {
    // if username or password are empty then disable login button otherwise enable login button
    if (($("#username").val().length == 0) || ($("#password").val().length == 0)) {
      $("#login").prop("disabled", true);
    } else {
      $("#login").prop("disabled", false);
    }
  },
  setDefaults : function() {
//    $("#username").focus();
  }
};
$(document).on("blur click keyup paste", "#username", function(event) {
  input.validateLength($("#username"), 1, true);
  input.validateLength($("#password"), 1, false);
  inputLocal.enableLogin();
});
$(document).on("blur click keyup paste", "#password", function(event) {
  input.validateLength($("#username"), 1, false);
  input.validateLength($("#password"), 1, true);
  inputLocal.enableLogin();
});
$(document).on("click", "#login", function(event) {
  input.setFormValues([ "mode" ], [ "login" ]);
});
//$(document).on('animationstart', '.my-input', function(event) {
//  var input = $(event.target).closest('.my-input');
//  switch(event.originalEvent.animationName) {
//    case 'onAutoFillStart':
//      console.log(input.val());
//      // ... do some other stuff
//      break;   
//    case 'onAutoFillCancel':
//      if (input.val() == '') {
//        console.log(input.val());
//        // ... do some other stuff
//      }
//  }
//});