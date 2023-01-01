"use script";
$(document).ready(function() {
  input.initialize();
});
$(document).on("click keyup paste", "#username, #email", function(event) {
  input.validateLength($("#username"), 1, false);
  input.validateLength($("#email"), 1, false);
  inputLocal.enableSend();
});
$(document).on("click", "#send", function(event) {
  $("#mode").val("resetPasswordRequest");
});
$(document).on("keyup paste", "#password, #confirmPassword", function(event) {
  inputLocal.validatePassword(event);
  inputLocal.enableSend();
});
$(document).on("click", "#resetPassword", function(event) {
  inputLocal.validatePassword(event);
  inputLocal.enableSend();
  $("#mode").val("resetPasswordConfirm");
});
const inputLocal = {
  enableSend : function() {
    $("#send").prop("disabled", !($("#username").val().length == 0 || /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($("#email").val())));
  },
  validatePassword : function(event) {
  	if ($("#password").length > 0) {
	  	if ($("#password").val().length == 0 || $("#confirmPassword").val().length == 0 || $("#password").val() != $("#confirmPassword").val()) {
	      $("#resetPassword").prop("disabled", true);
	      if (event) {
	        display.showErrors(["Passwords are blank or do not match"]);
	      	event.preventDefault();
	      	event.stopPropagation();
	      }
	  	} else {
	      $("#resetPassword").prop("disabled", false);
	      display.clearErrorsAndMessages();
	  	}
  	}
  }
};