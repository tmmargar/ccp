"use strict";
$(document).ready(function() {
  input.initialize();
});
$(document).on("click keyup paste", "input[id^='firstName_'], input[id^='lastName_'], input[id^='username_'], input[id^='password_'], input[id^='email_']", function(event) {
  input.validateLength($(this), 1, false);
  input.enable("save", inputLocal.enableSave);
});
const inputLocal = {
  enableSave : function(id) {
  	return ($("#firstName_" + id).val().length == 0) || ($("#lastName_" + id).val().length == 0) || ($("#username_" + id).val().length == 0) || ($("#mode").val() == "create" && $("#password_" + id).val().length == 0) || !(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($("#email_" + id).val()));
  },
  initializeDataTable : function() {
    dataTable.initialize("dataTbl", [{ "orderSequence": [ "desc", "asc" ], "width" : "4%" }, { "type" : "name", "width" : "11%" }, { "width" : "10%" }, { "width" : "15%" }, { "width" : "4%" }, { "width" : "8%" }, { "width" : "8%" }, { "width" : "7%" }, { "width" : "8%" }, { "width" : "7%" }, { "width" : "4%" }, { "searchable": false, "visible": false }], [ [ 10, "desc" ], [ 1, "asc" ] ], false, false, "375px");
  },
  postProcessing : function() {
    dataTable.displayHighlight("dataTbl", 4);
    dataTable.displayActive("dataTbl", 10);
  },
  setIds : function(selectedRow) {
    return $(selectedRow).children("td").first().html();
  },
  validate : function() {
    input.validateLength($("#firstName_"), 1, false);
    input.validateLength($("#lastName_"), 1, false);
    input.validateLength($("#username_"), 1, false);
    input.validateLength($("#password_"), 1, false);
    input.validateLength($("#email_"), 1, false);
  }
};