"use strict";
$(document).ready(function() {
  input.initialize();
});
$(document).on("click keyup paste", 'input[id^="groupName_"]', function(event) {
  input.validateLength($(this), 1, false);
  input.enable("save", inputLocal.enableSave);
});
const inputLocal = {
  enableSave : function(id) {
    return $("#groupName_" + id).val().length == 0;
  },
  initializeDataTable : function() {
    dataTable.initialize("dataTbl", [{ "orderSequence": [ "desc", "asc" ], "width" : "30%" }, { "width" : "70%" }, { "searchable": false, "visible": false }], [[ 1, "asc" ]]);
  },
  setIds : function(selectedRow) {
    return $(selectedRow).children("td").first().html();
  },
  validate : function() {
    input.validateLength($("#groupName_"), 1, false);
  },
};