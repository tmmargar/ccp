"use script";
$(document).ready(function() {
  //inputLocal.validate();
  inputLocal.enableSendRequest();
});
$(document).on("click keyup paste", "#username, #email", function(event) {
  inputLocal.validate();
});
$(document).on("click", "#sendRequest", function(event) {
  $("#mode").val("resetPasswordRequest");
});
$(document).on("keyup paste", "#password, #confirmPassword", function(event) {
  inputLocal.validatePassword(event);
});
$(document).on("click", "#resetPassword", function(event) {
  inputLocal.validatePassword(event);
  $("#mode").val("resetPasswordConfirm");
});
const inputLocal = {
	enableSendRequest : function() {
    if ($("#username").length > 0) {
    	if (($("#username").val().length == 0) || ($("#email").val().length == 0)) {
	      $("#sendRequest").prop("disabled", true);
	    } else {
	      $("#sendRequest").prop("disabled", false);
	    }
    }
  },
  validate : function() {
    input.validateLength($("#username"), 1, false);
    input.validateLength($("#email"), 1, false);
    inputLocal.enableSendRequest();
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