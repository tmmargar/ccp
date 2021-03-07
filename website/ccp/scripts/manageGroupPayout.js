"use strict";
$(document).ready(function() {
  input.initialize();
});
$(document).on("change keyup paste", 'select[id^="groupId_"], select[id^="payoutId_"]', function(event) {
  input.validateLength($(this), 1, false);
  input.enable("save", inputLocal.enableSave);
});
const inputLocal = {
  enableSave : function(id) {
    const idTemp = id.split("::")[0];
    return $("#groupId_" + idTemp).val().length == 0 || $("#payoutId_" + idTemp).val().length == 0;
  },
  setIds : function(selectedRow) {
    const htmlGroup = $(selectedRow).children("td:eq(0)").html();
    let positionStart = htmlGroup.indexOf("groupId=");
    const groupId = htmlGroup.substring(positionStart + 8, htmlGroup.indexOf("&", positionStart));
    const htmlPayout = $(selectedRow).children("td:eq(1)").html();
    positionStart = htmlPayout.indexOf("payoutId=");
    const payoutId = htmlPayout.substring(positionStart + 9, htmlPayout.indexOf("&", positionStart));
    return groupId + "::" + payoutId;
  },
  initializeDataTable : function() {
    dataTable.initialize("dataTbl", [{ "orderSequence": [ "desc", "asc" ], "width" : "15%", "visible": false }, { "width" : "50%" }, { "orderSequence": [ "desc", "asc" ], "width" : "15%", "visible": false }, { "width" : "50%" }, { "searchable": false, "visible": false }], [[ 1, "asc" ], [ 3, "asc" ]]);
  },
  validate : function() {
    input.validateLength($("#groupId_"), 1, false);
    input.validateLength($("#payoutId_"), 1, false);
    input.enable("save", inputLocal.enableSave);
  }
};