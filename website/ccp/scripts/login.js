"use script";
$(document).ready(function() {
  inputLocal.validate();
});
$(document).on("blur click keyup paste", "#username, #password", function(event) {
  inputLocal.validate();
});
$(document).on("click", "#login", function(event) {
  $("#mode").val(this.innerText.trim().toLowerCase());
  $("#frmLogin").submit();
});
const inputLocal = {
  enableLogin : function() {
    let result = $("#username").val().length == 0 || $("#password").val().length == 0;
    $("#login").prop("disabled", result);
  },
  validate : function() {
    input.validateLength($("#username"), 1, false);
    input.validateLength($("#password"), 1, false);
    inputLocal.enableLogin();
  }
};