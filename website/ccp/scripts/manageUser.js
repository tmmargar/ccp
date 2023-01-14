"use strict";
$(document).ready(function() {
  if ($("#mode").val() == "create" || $("#mode").val() == "modify") {
    $("body").css("maxWidth", "450px");
  }
  input.initialize();
  $("[id^='phone_']").mask("(000) 000-0000");
});
$(document).on("click keyup paste", "[id^='firstName_'], [id^='lastName_'], [id^='username_'], [id^='password_'], [id^='email_']", function(event) {
  input.validateLength($(this), 1, false);
  input.enable("save", inputLocal.enableSave);
});
$(document).on("input invalid", '[id^="phone_"]', function(event) {
  inputLocal.validatePhone(this);
});
$(document).on("submit", "form", function(event) {
  $("[id^='phone_']").unmask(); // submit value without mask
});
//$(document).on("reset", "form", function(event) {
/*$(document).on("click", "[id^='reset_']", function(event) {
  $("[id^='phone_']").val(6666666666);
  console.log("RESET 1 -> " + $("[id^='phone_']").val());
  $("[id^='phone_']").unmask();
  //$("[id^='phone_']").mask("(000) 000-0000");
  $("[id^='phone_']").mask("00-00-00-00-00");
  console.log("RESET 2 -> " + $("[id^='phone_']").val());
  $("[id^='phone_']").blur();
});*/
const inputLocal = {
  enableSave : function(id) {
    return ($("#firstName_" + id).val().length == 0) || ($("#lastName_" + id).val().length == 0) || ($("#username_" + id).val().length == 0) || ($("#mode").val() == "create" && $("#password_" + id).val().length == 0) || !(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($("#email_" + id).val()));
  },
  initializeDataTable : function() {
    dataTable.initialize("dataTbl", [{ "orderSequence": [ "desc", "asc" ], "width" : "4%" }, { "type" : "name", "width" : "11%" }, { "width" : "10%" }, { "width" : "15%" }, { "render" : function (data, type, row, meta) { return display.formatPhone(data); }, "width" : "8%" }, { "width" : "4%" }, { "width" : "8%" }, { "width" : "7%" }, { "width" : "7%" }, { "width" : "4%" }, { "searchable": false, "visible": false }], [ [ 9, "desc" ], [ 1, "asc" ] ], false, false, "375px");
  },
  postProcessing : function() {
    dataTable.displayHighlight("dataTbl", 5);
    dataTable.displayActive("dataTbl", 9);
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
  },
  validatePhone : function(obj) {
    let result = true;
    if (obj) {
      if (obj.validity.patternMismatch) {
        obj.setCustomValidity("Please enter a phone # in the format 1 (999) 999-9999");
        obj.reportValidity();
        obj.focus();
        $("[id^='save']").prop("disabled", true);
        result = false;
      } else {
        obj.setCustomValidity("");
        $("[id^='save']").prop("disabled", false);
      }
      return result;
    }
  }
};