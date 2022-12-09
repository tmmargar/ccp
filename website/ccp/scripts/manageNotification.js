"use strict";
jQuery(function(){
 $("[id^='notificationStartDate_']").datetimepicker({
  format:'m/d/Y',
  onShow:function( ct ){
   this.setOptions({
    maxDate:$("[id^='notificationEndDate_']").val()?$("[id^='notificationEndDate_']").val():false
   })
  },
  timepicker:false
 });
 $("[id^='notificationEndDate_']").datetimepicker({
  format:'m/d/Y',
  onShow:function( ct ){
   this.setOptions({
    minDate:$("[id^='notificationStartDate_']").val()?$("[id^='notificationStartDate_']").val():false
   })
  },
  timepicker:false
 });
});
$(document).ready(function() {
  input.initialize();
});
$(document).on("change keyup paste", "[id^='notificationStartDate_'], [id^='notificationEndDate_']", function(event) {
  input.validateLength($(this), 1, false);
  input.enable("save", inputLocal.enableSave);
  //$(this).datetimepicker(validate);
});
const inputLocal = {
  enableSave : function(id) {
    return (($("#notificationDescription_" + id).val() == "") || ($("#notificationStartDate_" + id).val().length == 0) || ($("#notificationEndDate_" + id).val().length == 0) || input.maskDateTime == $("#notificationStartDate_" + id).val() || input.maskDateTime == $("#notificationEndDate_" + id).val() || !input.compareDate($("[id^='notificationStartDate_']").val(), $("[id^='notificationEndDate_']").val()));
  },
  initializeDataTable : function() {
    dataTable.initialize("dataTbl", [{ "orderSequence": [ "desc", "asc" ], "width": "10%" }, { "width": "50%" }, { "width": "20%" }, { "width": "20%" }, { "orderable": false, "visible": false }], [[2, "desc"], [3, "desc"]]);
  },
  setDefaults : function() {
    input.initializeTimePicker();
  },
  setIds : function(selectedRow) {
    return $(selectedRow).children("td").first().html();
  },
  validate : function() {
    input.validateLength($("#notificationDescription_"), 1, false);
    input.validateLength($("#notificationStartDate_"), 1, false);
    input.validateLength($("#notificationEndDate_"), 1, false);
  }
};