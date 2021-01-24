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
  input.setFormValues([ "mode", "groupIds" ], [ "create", "" ]);
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
    inputLocal.setGroupIds(selectedRows);
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
    inputLocal.setGroupIds(selectedRows);
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
  input.setFormValues([ "mode", "groupIds" ], [ $("#mode").val(), $("#groupIds").val() ]);
});
$(document).on("click keyup paste", 'input[id^="groupName_"]', function(event) {
  input.validateLength($("#groupName_"), 1, true);
  inputLocal.enableSave();
  inputLocal.enableReset();
});
var inputLocal = {
  enableSave : function() {
    var id = $("#groupIds").val();
    if ($("#groupName_" + id).length > 0) {
      // if name, player, address, city, state, zip or phone are empty then disable save button otherwise enable save button
      if ($("#groupName_" + id).val().length == 0) {
        $("#save").prop("disabled", true);
      } else {
        $("#save").prop("disabled", false);
      }
    }
  },
  enableReset : function() {
    var id = $("#groupIds").val();
    if ($("#groupName_" + id).length > 0) {
      // if name is not empty then enable save button otherwise disable save button
      if ($("#groupName_" + id).val().length != 0) {
        $("#reset").prop("disabled", false);
      } else {
        $("#reset").prop("disabled", true);
      }
    }
  },
  setGroupIds : function(selectedRows) {
    var groupIds = "";
    for (var idx = 0; idx < selectedRows.length; idx++) {
      groupIds += $(selectedRows[idx]).children("td:first").html() + ", ";
    }
    groupIds = groupIds.substring(0, groupIds.length - 2);
    $("#groupIds").val(groupIds);
  },
  initializeDataTable : function() {
    $("#dataTbl").DataTable({
      "autoWidth" : false,
      "columns" : [{
    	  "orderSequence": [ "desc", "asc" ],
          "width" : "30%"
      }, {
        "width" : "70%"
      }, {
        "searchable": false,
        "visible": false
      }],
      "order" : [[ 1, "asc" ]],
      "paging": false,
      "scrollCollapse": true,
      "searching": false,
    });
  },
  setDefaults : function() {
  },
  initialValidation : function() {
    input.validateLength($("#groupName_"), 1, false);
  },
  postProcessing : function() {
  }
};