$(document).ready(function() {
  // use delay to pick up auto complete population so button is enabled
  setTimeout(function(){input.validateLength($(".selectize-input"), 1, false);}, 500); // 1/2 second
  setTimeout(function(){input.validateLength($("#subject"), 1, false);}, 500); // 1/2 second
  setTimeout(function(){input.validateLength($("#body"), 1, false);}, 500); // 1/2 second
  setTimeout(function(){inputLocal.enableEmail();}, 500); // 1/2 second
  inputLocal.setDefaults();
});
var inputLocal = {
  enableEmail : function() {
    // if username or password are empty then disable login button otherwise enable login button
    if (($("#subject").val().length == 0) || ($("#body").val().length == 0)) {
      $("#email").prop("disabled", true);
    } else {
      $("#email").prop("disabled", false);
    }
  },
  setDefaults : function() {
//    $("#subject").focus();
  }
};
$(document).on("blur click keyup paste", "#subject", function(event) {
  input.validateLength($(".selectize-input"), 1, false);
  input.validateLength($("#subject"), 1, true);
  input.validateLength($("#body"), 1, false);
  inputLocal.enableEmail();
});
$(document).on("blur click keyup paste", "#body", function(event) {
  input.validateLength($(".selectize-input"), 1, false);
  input.validateLength($("#subject"), 1, false);
  input.validateLength($("#body"), 1, true);
  inputLocal.enableEmail();
});
$(document).on("click", "#email", function(event) {
  input.setFormValues([ "mode" ], [ "email" ]);
});