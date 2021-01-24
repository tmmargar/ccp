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
  inputLocal.enableSave();
  event.stopImmediatePropagation();
});
$(document).on("click", "#rejectUserCheckAll", function(event) {
  input.toggleCheckboxes("rejectUser", "rejectUser");
  if ($(this).prop("checked")) {
    input.checkboxToggleAll("approveUser", false);
  }
  input.countChecked("rejectUser");
  inputLocal.enableSave();
  event.stopImmediatePropagation();
});
$(document).on("click", "input[id^='approveUser_']", function(event) {
  if ($(this).prop("checked")) {
    var values = $(this).prop("id").split("_");
    input.checkboxToggleSingle("rejectUser_" + values[1], false);
  }
  input.toggleCheckAll("approveUser", "approveUser");
  input.toggleCheckAll("rejectUser", "rejectUser");
  inputLocal.enableSave();
  input.countChecked("approveUser");
});
$(document).on("click", "input[id^='rejectUser_']", function(event) {
  if ($(this).prop("checked")) {
    var values = $(this).prop("id").split("_");
    input.checkboxToggleSingle("approveUser_" + values[1], false);
  }
  input.toggleCheckAll("approveUser", "approveUser");
  input.toggleCheckAll("rejectUser", "rejectUser");
  inputLocal.enableSave();
  input.countChecked("rejectUser");
});
$(document).on("click", "#save", function(event) {
  input.setFormValues([ "mode" ], [ "save" ]);
});
var inputLocal = {
  initializeTable : function() {
    $("#dataTblSignupApproval").DataTable({
      "autoWidth": false,
      "columns" : [ {
        "type" : "name"
      }, null,
         null,
         null,
      {
        "type" : "name"
      }, {
        "sortable": false
      }, {
        "sortable": false
      } ],
      "paging": false,
      "scrollCollapse": true,
      "searching": false
    });      
  },
//  enableApproval : function() {
//    if ($("input[id^='approveUser_']:checked").length == 0) {
//      $("#approve").prop("disabled", true);
//    } else {
//      $("#approve").prop("disabled", false);
//    }
//  },
//  enableRejection : function() {
//    if ($("input[id^='rejectUser_']:checked").length == 0) {
//      $("#reject").prop("disabled", true);
//    } else {
//      $("#reject").prop("disabled", false);
//    }
//  }
  enableSave : function() {
    if ($("input[id^='approveUser_']:checked").length == 0 && $("input[id^='rejectUser_']:checked").length == 0) {
      $("#save").prop("disabled", true);
    } else {
      $("#save").prop("disabled", false);
    }
  }
};