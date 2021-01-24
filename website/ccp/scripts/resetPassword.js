$(document).ready(function() {
  // use delay to pick up auto complete population so button is enabled
  setTimeout(function(){input.validateLength($("#username"), 1, false);}, 500); // 1/2 second
  setTimeout(function(){input.validateLength($("#email"), 1, false);}, 500); // 1/2 second
  setTimeout(function(){inputLocal.enableSendRequest();}, 500); // 1/2 second
  setTimeout(function(){inputLocal.validatePassword();}, 500); // 1/2 second
  inputLocal.setDefaults();
});
var inputLocal = {
	enableSendRequest : function() {
    // if username or email are empty then disable email button otherwise enable email button
    if ($("#username").length > 0) {
    	if (($("#username").val().length == 0) || ($("#email").val().length == 0)) {
	      $("#sendRequest").prop("disabled", true);
	    } else {
	      $("#sendRequest").prop("disabled", false);
	    }
    }
  },
  setDefaults : function() {
  	if ($("#username").length > 0) {
      $("#username").focus();
  	}
  	if ($("#password").length > 0) {
  		$("#password").focus();
  	}
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
$(document).on("click keyup paste", "#username", function(event) {
  input.validateLength($("#username"), 1, true);
  input.validateLength($("#email"), 1, false);
  inputLocal.enableSendRequest();
});
$(document).on("click keyup paste", "#email", function(event) {
  input.validateLength($("#username"), 1, false);
  input.validateLength($("#email"), 1, true);
  inputLocal.enableSendRequest();
});
$(document).on("click", "#sendRequest", function(event) {
  input.setFormValues(["mode"], ["resetPasswordRequest"]);
});
$(document).on("keyup paste", "#password", function(event) {
	inputLocal.validatePassword(event);
});
$(document).on("keyup paste", "#confirmPassword", function(event) {
	inputLocal.validatePassword(event);
});
$(document).on("click", "#resetPassword", function(event) {
	inputLocal.validatePassword(event);
	input.setFormValues(["mode"], ["resetPasswordConfirm"]);
});