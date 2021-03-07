"use strict";
$(document).ready(function() {
  input.validateLength($("#food"), 1, true)
});
$(document).on("keyup paste", "#food", function(event) {
  $("#register").prop("disabled", !("" == input.validateLength($(this), 1, true, "error")));
});
$(document).on("click", "#register", function(event) {
  $("#mode").val("savecreate");
});
$(document).on("click", "#unregister", function(event) {
  $("#mode").val("savemodify");
});