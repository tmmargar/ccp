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
  input.setFormValues([ "mode", "notificationIds" ], [ "create", "" ]);
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
    inputLocal.setNotificationIds(selectedRows);
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
    inputLocal.setNotificationIds(selectedRows);
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
  input.setFormValues([ "mode", "notificationIds" ], [ $("#mode").val(), $("#notificationIds").val() ]);
});
$(document).on("keyup paste", 'input[id^="notificationDescription_"]', function(event) {
  input.validateLength($(this), 1, false);
  inputLocal.enableSave();
});
$(document).on("change keyup paste", 'input[id^="notificationStartDate_"]', function(event) {
  input.validateLength($("#" + event.target.id), 1, true);
  inputLocal.enableSave();
});
$(document).on("change keyup paste", 'input[id^="notificationEndDate_"]', function(event) {
  input.validateLength($("#" + event.target.id), 1, true);
  inputLocal.enableSave();
});
var inputLocal = {
  enableSave : function() {
    if ($("#save").length > 0) {
      var ids = $("#notificationIds").val();
      var aryId = ids.split(", ");
      for (var idx=0; idx < aryId.length; idx++) {
        if (($("#notificationDescription_" + aryId[idx]).val() == "") || ($("#notificationStartDate_" + aryId[idx]).val().length == 0) || ($("#notificationEndDate_" + aryId[idx]).val().length == 0)) {
          $("#save").prop("disabled", true);
        } else {
          $("#save").prop("disabled", false);
          break;
        }
      }
    }
  },
  setNotificationIds : function(selectedRows) {
    var notificationIds = "";
    for (var idx = 0; idx < selectedRows.length; idx++) {
      notificationIds += $(selectedRows[idx]).children("td:first").html() + ", ";
    }
    notificationIds = notificationIds.substring(0, notificationIds.length - 2);
    $("#notificationIds").val(notificationIds);
  },
  initializeDataTable : function() {
    $("#dataTbl").DataTable({
      "autoWidth": false,
      "columns": [
        { "orderSequence": [ "desc", "asc" ],
          "width": "10%" },
        { "width": "30%" },
        { "width": "30%" },
        { "width": "30%" },
        { "orderable": false, "visible": false },
      ],
      "order": [[ 2, "desc"], [ 3, "desc"]],
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
    input.validateLength($("#notificationDesc_"), 1, false);
    input.validateLength($("#notificationStartDate_"), 1, false);
    input.validateLength($("#notificationEndDate_"), 1, false);
  },
  postProcessing : function() {
  },
  initializeTimePicker : function() {
    $(".timePicker").datetimepicker({
      format: "m/d/Y H:i",
      lastInit: true,
      mask: true,
      yearStart: "2005"
    });
  },
  customValidation : function() {
  }
};