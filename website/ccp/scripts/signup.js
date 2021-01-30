$(document).ready(function() {
  // use delay to pick up auto complete population so button is enabled
  setTimeout(function(){input.validateLength($("#name"), 1, false);}, 500); // 1/2 second
  //if (!$("#username").hasClass("errors")) {
    setTimeout(function(){input.validateLength($("#username"), 1, false);}, 500); // 1/2 second
  //}
  //if (!$("#email").hasClass("errors")) {
    setTimeout(function(){input.validateLength($("#email"), 1, false);}, 500); // 1/2 second
  //}
  setTimeout(function(){input.validateLength($("#password"), 1, false);}, 500); // 1/2 second
  setTimeout(function(){input.validateLength($("#confirmPassword"), 1, false);}, 500); // 1/2 second
  setTimeout(function(){inputLocal.enableSignUp();}, 500); // 1/2 second
//  inputLocal.setDefaults();
});
var inputLocal = {
  enableSignUp : function() {
    if (($("#name").val().length == 0) || ($("#username").val().length == 0) ||
        ($("#email").val().length == 0) || ($("#password").val().length == 0) ||
        ($("#confirmPassword").val().length == 0) || $("#password").val() != $("#confirmPassword").val() ||
        !(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($("#email").val()))) {
      $("#signUp").prop("disabled", true);
    } else {
      $("#signUp").prop("disabled", false);
    }
  },
};
$(document).on("click keyup paste", "#name", function(event) {
  input.validateLength($("#name"), 1, true);
  input.validateLength($("#username"), 1, false);
  input.validateLength($("#email"), 1, false);
  input.validateLength($("#password"), 1, false);
  input.validateLength($("#confirmPassword"), 1, false);
  inputLocal.enableSignUp();
});
$(document).on("click keyup paste", "#username", function(event) {
  input.validateLength($("#name"), 1, false);
  input.validateLength($("#username"), 1, true);
  input.validateLength($("#email"), 1, false);
  input.validateLength($("#password"), 1, false);
  input.validateLength($("#confirmPassword"), 1, false);
  inputLocal.enableSignUp();
});
$(document).on("click keyup paste", "#email", function(event) {
  input.validateLength($("#name"), 1, false);
  input.validateLength($("#username"), 1, false);
  input.validateLength($("#email"), 1, true);
  input.validateLength($("#password"), 1, false);
  input.validateLength($("#confirmPassword"), 1, false);
  inputLocal.enableSignUp();
});
$(document).on("click keyup paste", "#password", function(event) {
  input.validateLength($("#name"), 1, false);
  input.validateLength($("#username"), 1, false);
  input.validateLength($("#email"), 1, false);
  input.validateLength($("#password"), 1, true);
  input.validateLength($("#confirmPassword"), 1, false);
  inputLocal.enableSignUp();
});
$(document).on("click keyup paste", "#confirmPassword", function(event) {
  input.validateLength($("#name"), 1, false);
  input.validateLength($("#username"), 1, false);
  input.validateLength($("#email"), 1, false);
  input.validateLength($("#password"), 1, false);
  input.validateLength($("#confirmPassword"), 1, true);
  inputLocal.enableSignUp();
});
$(document).on("click", "#signUp", function(event) {
  input.setFormValues([ "mode" ], [ "signup" ]);
});