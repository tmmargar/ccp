"use strict";
$(document).ready(function() {
  input.validateLength($("#food"), 1, true)
});
$(document).on("keyup paste", "#food", function(event) {
  const result = ("" == input.validateLength($(this), 1, true, "You must enter a dish"));
  $("#register").prop("disabled", !result);
  if (result) {
    display.clearErrorsAndMessages();
  }
});
$(document).on("click", "#register", function(event) {
  $("#mode").val("savecreate");
});
$(document).on("click", "#unregister", function(event) {
  $("#mode").val("savemodify");
});