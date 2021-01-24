$(document).ready(function() {
  inputLocal.initializeDataTable();
  inputLocal.setDefaults();
  inputLocal.initialValidation();
  inputLocal.enableSave();
  inputLocal.postProcessing();
});
$(document).on("click", "#dataTbl tr", function(event) {
  if ($(this).hasClass("selected")) {
    $("#modify").prop("disabled", false);
    $("#delete").prop("disabled", false);
  } else {
    $("#modify").prop("disabled", true);
    $("#delete").prop("disabled", true);
  }
  if ($(".selected").length > 1) {
    $(this).removeClass("selected");
  }
});
$(document).on("click", "#create", function(event) {
  input.setFormValues([ "mode", "specialTypeIds" ], [ "create", "" ]);
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
    inputLocal.setSpecialTypeIds(selectedRows);
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
    inputLocal.setSpecialTypeIds(selectedRows);
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
  input.setFormValues([ "mode", "specialTypeIds" ], [ $("#mode").val(), $("#specialTypeIds").val() ]);
});
$(document).on("keyup paste", 'input[id^="specialTypeDescription_"]', function(event) {
  input.validateLength($(this), 1, false);
  inputLocal.enableSave();
});
$(document).on("change keyup paste", 'input[id^="specialTypeStartDate_"]', function(event) {
  input.validateLength($("#" + event.target.id), 1, true);
  inputLocal.enableSave();
});
$(document).on("change keyup paste", 'input[id^="specialTypeEndDate_"]', function(event) {
  input.validateLength($("#" + event.target.id), 1, true);
  inputLocal.enableSave();
});
var inputLocal = {
  enableSave : function() {
    if ($("#save").length > 0) {
      var ids = $("#specialTypeIds").val();
      var aryId = ids.split(", ");
      for (var idx=0; idx < aryId.length; idx++) {
        if (($("#specialTypeDescription_" + aryId[idx]).val() == "")) {
          $("#save").prop("disabled", true);
        } else {
          $("#save").prop("disabled", false);
          break;
        }
      }
    }
  },
  setSpecialTypeIds : function(selectedRows) {
    var specialTypeIds = "";
    for (var idx = 0; idx < selectedRows.length; idx++) {
      specialTypeIds += $(selectedRows[idx]).children("td:first").html() + ", ";
    }
    specialTypeIds = specialTypeIds.substring(0, specialTypeIds.length - 2);
    $("#specialTypeIds").val(specialTypeIds);
  },
  initializeDataTable : function() {
    $("#dataTbl").DataTable({
      "autoWidth": false,
      "columns": [
        { "orderSequence": [ "desc", "asc" ],
          "width": "20%" },
        { "width": "80%" },
        { "orderable": false, "visible": false },
      ],
      "order": [[ 1, "asc"]],
      "paging": false,
      "scrollY": "300px",
      "scrollResize": true,
      "scrollCollapse": true
    });
  },
  setDefaults : function() {
  },
  initialValidation : function() {
    input.validateLength($("#specialTypeDesc_"), 1, false);
  },
  postProcessing : function() {
  },
  customValidation : function() {
  }
};