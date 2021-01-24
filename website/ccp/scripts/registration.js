$(document).ready(function() {
  input.validateLength($("#food"), 1, true)
});
$(document).on("keyup paste", "#food", function(event) {
  if ("" == input.validateLength($(this), 1, true, "error")) {
    $("#register").prop("disabled", false);
  } else {
    $("#register").prop("disabled", true);
  }
});
$(document).on("click", "#register", function(event) {
  input.setFormValues(["mode"], ["savecreate"]);
});
$(document).on("click", "#unregister", function(event) {
  input.setFormValues(["mode"], ["savemodify"]);
});
