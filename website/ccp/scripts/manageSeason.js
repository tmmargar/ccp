"use strict";
jQuery(function(){
  inputLocal.initializeTimePicker();
});
$(document).ready(function() {
  input.initialize();
});
$(document).on("change keyup paste", "[id^='seasonDescription_'], [id^='seasonStartDate_'], [id^='seasonEndDate_']", function(event) {
  input.validateLength($(this), 1, false);
  input.enable("save", inputLocal.enableSave);
});
$(document).on("keyup paste", "[id^='seasonChampionshipQualify_']", function(event) {
  input.validateNumberOnlyGreaterZero($(this), event);
  input.validateLength($(this), 1, false);
  input.enable("save", inputLocal.enableSave);
});
$(document).on("reset", "form", function(event) {
  $("[id^='seasonStartDate_']").datetimepicker("reset");
  $("[id^='seasonEndDate_']").datetimepicker("reset");
  //inputLocal.initializeTimePicker();
});
const inputLocal = {
  enableSave : function(id) {
    return (($("#seasonDescription_" + id).val() == "") || ($("#seasonStartDate_" + id).val().length == 0) || ($("#seasonEndDate_" + id).val().length == 0) || ($("#seasonChampionshipQualify_" + id).val() <= 0) || !input.compareDate($("[id^='seasonStartDate_']").val(), $("[id^='seasonEndDate_']").val()));
  },
  initializeDataTable : function() {
    dataTable.initialize("dataTbl", [{ "orderSequence": [ "desc", "asc" ], "width": "5%" }, { "width": "25%" }, { "type": "date", "width": "25%" }, { "type": "date", "width": "25%" }, { "width": "10%" }, { "width": "10%" }, { "orderable": false, "visible": false }], [[5, "desc"], [2, "desc"]], true, false, "300px");
  },
  initializeTimePicker : function() {
    if ("create" == $("#mode").val()) {
      const startDate = "01/01/" + (new Date().getFullYear() + 1);
      $("[id^='seasonStartDate_']").prop("defaultValue", startDate);
      $("[id^='seasonStartDate_']").val(startDate);
      $("[id^='seasonStartDate_']").datetimepicker({
        format:'m/d/Y',
        onShow:function( ct ){
         this.setOptions({
          maxDate:$("[id^='seasonEndDate_']").val()?$("[id^='seasonEndDate_']").val():false,
          minDate:startDate,
          defaultDate:startDate,
          startDate:startDate
         })
        },
        timepicker:false
       });
       const endDate = "12/31/" + (new Date().getFullYear() + 1);
       $("[id^='seasonEndDate_']").prop("defaultValue", endDate);
       $("[id^='seasonEndDate_']").val(endDate);
       $("[id^='seasonEndDate_']").datetimepicker({
        format:'m/d/Y',
        onShow:function( ct ){
         this.setOptions({
          minDate:$("[id^='seasonStartDate_']").val()?$("[id^='seasonStartDate_']").val():false,
          defaultDate:endDate,
          startDate:endDate
         })
        },
        timepicker:false
      });
    }    
  },
  postProcessing : function() {
    dataTable.displayActive("dataTbl", 5);
  },
  setDefaults : function() {
    input.initializeTimePicker("m/d/Y", false);
  },
  setIds : function(selectedRow) {
    return $(selectedRow).children("td").first().html();
  },
  validate : function() {
    input.validateLength($("#seasonDescription_"), 1, false);
    input.validateLength($("#seasonStartDate_"), 1, false);
    input.validateLength($("#seasonEndDate_"), 1, false);
    input.validateLength($("#seasonChampionshipQualify_"), 1, false);
  }
};