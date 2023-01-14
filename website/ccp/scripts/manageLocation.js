"use strict";
$(document).ready(function() {
  input.initialize();
  $("[id^='playerId_']").trigger("focus");
});
$(document).on("click keyup paste", "[id^='locationName_'], [id^='playerId_'], [id^='address_']", function(event) {
  input.validateLength($(this), 1, true);
  inputLocal.buildName($("#ids").val().split(", ")[0]);
  input.enable("save", inputLocal.enableSave);
});
$(document).on("click keyup paste", '[id^="city_"]', function(event) {
  input.validateLetterOnly($(this), event);
  input.validateLength($("#city_"), 1, true);
  inputLocal.buildName($("#ids").val().split(", ")[0]);
  input.enable("save", inputLocal.enableSave);
});
$(document).on("change", '[id^="states_"]', function(event) {
  input.enable("save", inputLocal.enableSave);
});
$(document).on("click keyup paste", '[id^="zipCode_"]', function(event) {
  // add check to prevent 5 zeroes and handle leading zeroes
  input.validateNumberOnly($(this), event, true);
  const result = input.validateLength($(this), 5, true, "You have entered " + $(this).val().length + " of 5 digits for zipCode");
  if (result == "") {
    display.clearErrorsAndMessages();
  }
  input.enable("save", inputLocal.enableSave);
});
$(document).on("click", '[id^="active_"]', function(event) {
  input.enable("save", inputLocal.enableSave);
});
const inputLocal = {
  buildName : function(id) {
    $("#locationName_" + id).val($("#playerId_" + id + " option:selected").text() + " - " + $("#city_" + id).val());
  },
  enableSave : function(id) {
    return ($("#locationName_" + id).val().length == 0) || ($("#playerId_" + id).val() == "") || ($("#address_" + id).val().length == 0) || ($("#city_" + id).val().length == 0) || ($("#states_" + id).val() == "") || ($("#zipCode_" + id).val().length < 5);
  },
  initializeDataTable : function() {
    dataTable.initialize("dataTbl", [{"orderSequence": [ "desc", "asc" ], "width" : "2%" }, { "type" : "locationName", "width" : "19%" }, { "type" : "host", "width" : "15%" }, { "searchable": false, "type" : "address", "width" : "21%" }, { "searchable": false, "width" : "11%" }, { "searchable": false, "width" : "5%" }, { "searchable": false, "width" : "4%" }, { "width" : "7%" }, { "width" : "7%" }, { "searchable": false, "visible": false }], [[7, "desc"], [2, "asc"]], true, false, "300px");
  },
  postProcessing : function() {
    dataTable.displayActive("dataTbl", 7);
  },
  save : function(event) {
    $("[id^='states_']").each(function(index) {
      $(this).prop("disabled", false);
    });
    return true;
  },
  setDefaults : function() {
    if ($("#mode").val() == "create") {
      $("#states_").val("MI");
    }
    $("[id^='states_']").each(function(index) {
      $(this).prop("disabled", true);
    });
  },
  setIds : function(selectedRow) {
    return $(selectedRow).children("td").first().html();
  },
  tableRowClick : function(obj) {
    $("[id^='delete']").prop("disabled", !($(obj).find("td").eq(8).text() == 0));
  },
  validate : function() {
    input.validateLength($("#locationName_"), 1, false);
    input.validateLength($("#playerId_"), 1, false);
    input.validateLength($("#address_"), 1, false);
    input.validateLength($("#city_"), 1, false);
    input.validateLength($("#zipCode_"), 1, false);
  }
};