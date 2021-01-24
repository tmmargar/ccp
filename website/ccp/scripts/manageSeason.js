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
  input.setFormValues([ "mode", "seasonIds" ], [ "create", "" ]);
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
    inputLocal.setSeasonIds(selectedRows);
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
    inputLocal.setSeasonIds(selectedRows);
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
  input.setFormValues([ "mode", "seasonIds" ], [ $("#mode").val(), $("#seasonIds").val() ]);
});
$(document).on("keyup paste", 'input[id^="seasonDescription_"]', function(event) {
  input.validateLength($(this), 1, false);
  inputLocal.enableSave();
});
$(document).on("change keyup paste", 'input[id^="seasonStartDate_"]', function(event) {
  input.validateLength($("#" + event.target.id), 1, true);
  inputLocal.enableSave();
});
$(document).on("change keyup paste", 'input[id^="seasonEndDate_"]', function(event) {
  input.validateLength($("#" + event.target.id), 1, true);
  inputLocal.enableSave();
});
var inputLocal = {
  enableSave : function() {
    if ($("#save").length > 0) {
      var ids = $("#seasonIds").val();
      var aryId = ids.split(", ");
      for (var idx=0; idx < aryId.length; idx++) {
        if (($("#seasonDescription_" + aryId[idx]).val() == "") || ($("#seasonStartDate_" + aryId[idx]).val().length == 0) || ($("#seasonEndDate_" + aryId[idx]).val().length == 0)) {
          $("#save").prop("disabled", true);
        } else {
          $("#save").prop("disabled", false);
          break;
        }
      }
    }
  },
  setSeasonIds : function(selectedRows) {
    var seasonIds = "";
    for (var idx = 0; idx < selectedRows.length; idx++) {
      seasonIds += $(selectedRows[idx]).children("td:first").html() + ", ";
    }
    seasonIds = seasonIds.substring(0, seasonIds.length - 2);
    $("#seasonIds").val(seasonIds);
  },
  initializeDataTable : function() {
    $("#dataTbl").DataTable({
      "autoWidth": false,
      "columns": [
        { "orderSequence": [ "desc", "asc" ],
          "width": "5%" },
        { "width": "30%" },
        { "width": "30%" },
        { "width": "30%" },
        { "width": "5%" },
        { "orderable": false, "visible": false },
      ],
      "order": [[ 4, "desc"]],
      "paging": false,
      "scrollY": "300px",
      "scrollResize": true,
      "scrollCollapse": true
    });
  },
  setDefaults : function() {
    inputLocal.initializeTimePicker();
  },
  initialValidation : function() {
    input.validateLength($("#seasonDesc_"), 1, false);
    input.validateLength($("#seasonStartDate_"), 1, false);
    input.validateLength($("#seasonEndDate_"), 1, false);
  },
  postProcessing : function() {
    //$("input[id^='seasonDescription_']").focus();
    $("#dataTbl tr").each(function(index) {
      var cell = $(this).find("td:eq(4)");
      $(this).addClass(cell.text() == "0" ? "inactive" : "");
      cell.text(cell.text() == "1" ? "Yes" : "No");
    });
  },
  initializeTimePicker : function() {
    $(".timePicker").datetimepicker({
      format: "m/d/Y",
      lastInit: true,
      mask: true,
      timepicker: false,
      yearStart: "2005"
    });
  },
  customValidation : function() {
  }
};