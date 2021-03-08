"use script";
$(document).ready(function() {
  inputLocal.validate();
});
$(document).on("blur click keyup paste", "#username, #password", function(event) {
  inputLocal.validate();
});
$(document).on("click", "#login", function(event) {
  $("#mode").val(this.value.toLowerCase());
});
const inputLocal = {
  enableLogin : function() {
    $("#login").prop("disabled", $("#username").val().length == 0 || $("#password").val().length == 0);
  },
  validate : function() {
    input.validateLength($("#username"), 1, false);
    input.validateLength($("#password"), 1, false);
    inputLocal.enableLogin();
  }
};