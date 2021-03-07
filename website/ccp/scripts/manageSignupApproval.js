"use strict";
$(document).ready(function() {
  inputLocal.initializeTable();
  inputLocal.enableSave();
  input.countChecked("approveUser");
  input.countChecked("rejectUser");
});
$(document).on("click", "#approveUserCheckAll", function(event) {
  input.toggleCheckboxes("approveUser", "approveUser");
  if ($(this).prop("checked")) {
    input.checkboxToggleAll("rejectUser", false);
  }
  input.countChecked("approveUser");
  input.countChecked("rejectUser");
  inputLocal.enableSave();
  event.stopImmediatePropagation();
});
$(document).on("click", "#rejectUserCheckAll", function(event) {
  input.toggleCheckboxes("rejectUser", "rejectUser");
  if ($(this).prop("checked")) {
    input.checkboxToggleAll("approveUser", false);
  }
  input.countChecked("approveUser");
  input.countChecked("rejectUser");
  inputLocal.enableSave();
  event.stopImmediatePropagation();
});
$(document).on("click", "input[id^='approveUser_']", function(event) {
  if ($(this).prop("checked")) {
    const values = $(this).prop("id").split("_");
    input.checkboxToggleSingle("rejectUser_" + values[1], false);
    input.countChecked("rejectUser");
  }
  input.toggleCheckAll("approveUser", "approveUser");
  input.toggleCheckAll("rejectUser", "rejectUser");
  inputLocal.enableSave();
  input.countChecked("approveUser");
});
$(document).on("click", "input[id^='rejectUser_']", function(event) {
  if ($(this).prop("checked")) {
    const values = $(this).prop("id").split("_");
    input.checkboxToggleSingle("approveUser_" + values[1], false);
    input.countChecked("approveUser");
  }
  input.toggleCheckAll("approveUser", "approveUser");
  input.toggleCheckAll("rejectUser", "rejectUser");
  inputLocal.enableSave();
  input.countChecked("rejectUser");
});
const inputLocal = {
  initializeTable : function() {
    dataTable.initialize("dataTblSignupApproval", [ { "type" : "name" }, null, null, null, { "type" : "name" }, { "sortable": false }, { "sortable": false } ]);
  },
  enableSave : function() {
    $("#save").prop("disabled", $("input[id^='approveUser_']:checked").length == 0 && $("input[id^='rejectUser_']:checked").length == 0);
  }
};