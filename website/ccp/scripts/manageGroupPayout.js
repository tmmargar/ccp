$(document).ready(function() {
  inputLocal.initializeDataTable();
  inputLocal.setDefaults();
  inputLocal.initialValidation();
  inputLocal.postProcessing();
  inputLocal.enableSave();
  inputLocal.enableReset();
});
$(document).on("click", "#dataTbl tr", function(event) {
  if ($(this).hasClass("selected")) {
    $("#modify").prop("disabled", false);
    $("#delete").prop("disabled", false);
  } else {
    $("#modify").prop("disabled", true);
    $("#delete").prop("disabled", true);
  }
  /*if ($(".selected").length > 1) {
    $(this).removeClass("selected");
  }*/
});
$(document).on("click", "#create", function(event) {
  input.setFormValues([ "mode", "groupPayoutIds" ], [ "create", "" ]);
});
$(document).on("click", "#modify", function(event) {
  var selectedRows = dataTable.getSelectedRows($("#dataTbl").dataTable());
  if (selectedRows.length == 0) {
    display.showErrors([ "You must select a row to modify" ]);
    event.preventDefault();
    event.stopPropagation();
  } else if (selectedRows.length > 1) {
    display.showErrors([ "You must select only 1 row to modify" ]);
    event.preventDefault();
    event.stopPropagation();
  } else {
    inputLocal.setGroupPayoutIds(selectedRows);
    input.setFormValues([ "mode" ], [ "modify" ]);
  }
});
$(document).on("click", "#delete", function(event) {
  var selectedRows = dataTable.getSelectedRows($("#dataTbl").dataTable());
  if (selectedRows.length == 0) {
    display.showErrors([ "You must select a row to delete" ]);
    event.preventDefault();
    event.stopPropagation();
  } else {
    inputLocal.setGroupPayoutIds(selectedRows);
    input.setFormValues([ "mode" ], [ "delete" ]);
  }
});
$(document).on("click", "#confirmDelete", function(event) {
  input.setFormValues([ "mode" ], [ "confirm" ]);
});
$(document).on("click", "#cancel", function(event) {
  input.setFormValues([ "mode" ], [ "view" ]);
});
$(document).on("click", "#save", function(event) {
  input.setFormValues(["mode"], ["save" + $("#mode").val()]);
});
$(document).on("click", "#reset", function(event) {
  input.setFormValues([ "mode", "groupPayoutIds" ], [ $("#mode").val(), $("#groupPayoutIds").val() ]);
});
$(document).on("change keyup paste", 'select[id^="groupId_"], select[id^="payoutId_"]', function(event) {
  input.validateLength($("#groupId_"), 1, true);
  input.validateLength($("#payoutId_"), 1, true);
  inputLocal.enableSave();
  inputLocal.enableReset();
});
var inputLocal = {
  enableSave : function() {
    var id = $("#groupPayoutIds").val().split("::")[0];
    if ($("#groupId_" + id).length > 0) {
      if ($("#groupId_" + id).val().length == 0 || $("#payoutId_" + id).val().length == 0) {
        $("#save").prop("disabled", true);
      } else {
        $("#save").prop("disabled", false);
      }
    }
  },
  enableReset : function() {
    var id = $("#groupPayoutIds").val().split("::")[0];
    if ($("#groupId_" + id).length > 0) {
      if ($("#groupId_" + id).val().length != 0 || $("#payoutId_" + id).val().length != 0) {
        $("#reset").prop("disabled", false);
      } else {
        $("#reset").prop("disabled", true);
      }
    }
  },
  setGroupPayoutIds : function(selectedRows) {
    var groupPayoutIds = "";
    for (var idx = 0; idx < selectedRows.length; idx++) {
      //groupPayoutIds += $(selectedRows[idx]).children("td:eq(0)").html() + "::" + $(selectedRows[idx]).children("td:eq(1)").html() + ", ";
      var htmlGroup = $(selectedRows[idx]).children("td:eq(0)").html();
      var positionStart = htmlGroup.indexOf("groupId=");
      var groupId = htmlGroup.substring(positionStart + 8, htmlGroup.indexOf("&", positionStart));
      var htmlPayout = $(selectedRows[idx]).children("td:eq(1)").html();
      var positionStart = htmlPayout.indexOf("payoutId=");
      var payoutId = htmlPayout.substring(positionStart + 9, htmlPayout.indexOf("&", positionStart));
      groupPayoutIds += groupId + "::" + payoutId + ", ";
    }
    groupPayoutIds = groupPayoutIds.substring(0, groupPayoutIds.length - 2);
    $("#groupPayoutIds").val(groupPayoutIds);
  },
  initializeDataTable : function() {
    $("#dataTbl").DataTable({
      "autoWidth" : false,
      "columns" : [{
    	  "orderSequence": [ "desc", "asc" ],
          "width" : "15%",
          "visible": false
      }, {
        "width" : "50%"
      }, {
        "orderSequence": [ "desc", "asc" ],
          "width" : "15%",
          "visible": false
      }, {
        "width" : "50%"
      }, {
        "searchable": false,
        "visible": false
      }],
      "order" : [[ 1, "asc" ], [ 3, "asc" ]],
      "paging": false,
      "scrollCollapse": true,
      "searching": false,
    });
  },
  setDefaults : function() {
  },
  initialValidation : function() {
    input.validateLength($("#groupId_"), 1, false);
    input.validateLength($("#payoutId_"), 1, false);
  },
  postProcessing : function() {
  }
};