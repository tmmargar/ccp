$(document).ready(function() {
  input.validateLength($("#username"), 1, true);
  input.validateLength($("#password"), 1, false);
  inputLocal.enableLogin();
  inputLocal.setDefaults();
});
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
  }
};