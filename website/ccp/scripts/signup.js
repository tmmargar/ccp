"use script";
$(document).on("keyup paste", "#name, #username, #email, #password, #confirmPassword", function(event) {
  inputLocal.validate();
  inputLocal.enableSignUp();
});
$(document).on("click", "#signUp", function(event) {
  $("#mode").val(this.value.toLowerCase().replace(" ", ""));
});
const inputLocal = {
  enableSignUp : function() {
    if (($("#name").val().length == 0)) {
      $("#signUp").prop("disabled", true);
      input.invalid($("#name"));
      display.showErrors(["Name is blank"]);
    } else if (!(/.+\s.+$/.test($("#name").val()))) {
      $("#signUp").prop("disabled", true);
      input.invalid($("#name"));
      display.showErrors(["Your name is not a valid format (must include first and last separate by space)"]);
    } else if (($("#email").val().length == 0)) {
      $("#signUp").prop("disabled", true);
      input.invalid($("#email"));
      display.showErrors(["Email is blank"]);
    } else if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($("#email").val()))) {
      $("#signUp").prop("disabled", true);
      input.invalid($("#email"));
      display.showErrors(["Your email is not a valid format (a@b.cd)"]);
    } else if (($("#username").val().length == 0)) {
      $("#signUp").prop("disabled", true);
      input.invalid($("#username"));
      display.showErrors(["Username is blank"]);
    } else if (($("#password").val().length == 0) || ($("#confirmPassword").val().length == 0) || $("#password").val() != $("#confirmPassword").val()) {
      $("#signUp").prop("disabled", true);
      input.invalid($("#password"));
      input.invalid($("#confirmPassword"));
      display.showErrors(["Your passwords are blank or do not match"]);
    } else {
      $("#signUp").prop("disabled", false);
    }
  },
  validate : function() {
    input.validateLength($("#name"), 1, false);
    input.validateLength($("#username"), 1, false);
    input.validateLength($("#email"), 1, false);
    input.validateLength($("#password"), 1, false);
    input.validateLength($("#confirmPassword"), 1, false);
  }
};