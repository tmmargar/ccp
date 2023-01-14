"use strict";
$(document).ready(function() {
  input.initialize();
});
$(document).on("click keyup paste", '[id^="payoutName_"], [id^="bonusPoints_"], [id^="minPlayers_"], [id^="maxPlayers_"]', function(event) {
  input.validateLength($(this), 1, false);
  input.enable("save", inputLocal.enableSave);
});
$(document).on("click keyup paste", '[id^="percentage_"]', function(event) {
  input.validateNumberOnlyGreaterZero($(this), event, false, false);
  inputLocal.calculateTotal(this.id);
  input.enable("save", inputLocal.enableSave);
});
$(document).on("click", '[id^="addRow"]', function(event) {
  inputLocal.addRow("inputs");
  inputLocal.enableButtons();
});
$(document).on("click", '[id^="removeRow"]', function(event) {
  inputLocal.removeRow("inputs");
  inputLocal.enableButtons();
});
const inputLocal = {
  addRow : function(objId) {
    let newId;
    // clone last row and adjust index by 1
    const newRow = $("#" + objId + " tr:nth-last-child(2)").clone();
    newRow.find(":input").each(function(index) {
      $(this).attr({
        "disabled": function(_, disabled) {
          if (this.id.indexOf("place_") == -1) {
            return false;
          } else {
            return true;
          }
        },
        "id": function(_, id) {
          const idVal = id.split("_");
          newId = (parseInt(idVal[2]) + 1);
          return idVal[0] + "_" + idVal[1] + "_" + newId;
        },
        "name": function(_, name) {
          const nameVal = name.split("_");
          return nameVal[0] + "_" + nameVal[1] + "_" + (parseInt(nameVal[2]) + 1);
        }
      });
      $(this).prop({
        "checked": function(_, checked) {
          return false;
        },
        "value": function(_, value) {
          if (this.id.indexOf("place_") == -1) {
            return 0;
          } else {
            return parseInt(value) + 1;
          }
        }
      });
    }).end().insertAfter("#" + objId + " tr:nth-last-child(2)");
  },
  calculateTotal : function(objId) {
    let total = 0;
    $("[id^='percentage_']").each(function(index) {
      if ($(this).val() == "") {
        $(this).val(0);
      }
      total += parseInt($(this).val());
    });
    if (100 < total) {
      if (undefined != objId) {
        $("#" + objId).val($("#" + objId).data("previousValue"));
      }
    } else {
      //TODO: validate previous and next to make sure largest to smallest
      /*const id = objId.split("_");
      // check to make sure less than previous value
      //if (this.value != "" && parseInt(this.value) != 0) {
        //console.log(this.value + " >= " + $("#percentage_" + id[1] + "_" + (id[2] - 1)).val());
      if (id[2] > 0 && parseInt($("#" + objId).val()) >= parseInt($("#percentage_" + id[1] + "_" + (id[2] - 1)).val())) {
        console.log("invalid");
        $("#" + objId).val($("#" + objId).data("previousValue"));
      } else {*/
        $("#percentageTotal").val(total);
        if (undefined != objId) {
          $("#" + objId).data("previousValue", $("#" + objId).val());
        }
      //}
    }
  },
  enableButtons : function() {
    $('[id^="addRow"]').prop("disabled", !$("#inputs tr").length == 2);
    $('[id^="removeRow"]').prop("disabled", $("#inputs tr").length == 2);
  },
  enableSave : function(id) {
    return $("#payoutName_" + id).val().length == 0 || $("#percentageTotal").val() != 100;
  },
  initializeDataTable : function() {
    const aryRowGroup = {
      startRender: null,
      endRender: function ( rows, group, level ) {
        const bonusPoints = undefined == rows.data().pluck(2)[0] ? 0 : rows.data().pluck(2)[0];
        const minPlayers = undefined == rows.data().pluck(3)[0] ? 0 : rows.data().pluck(3)[0];
        const maxPlayers = undefined == rows.data().pluck(4)[0] ? 0 : rows.data().pluck(4)[0];
        return $('<tr/>').append('<td colspan="4">Payout for ' + group + ' has bonus points ' + bonusPoints + ', min players ' + minPlayers + ' and max players ' + maxPlayers + '</td>\n');
      },
      dataSrc: 1
    };
    dataTable.initialize("dataTbl", [{"orderSequence": [ "desc", "asc" ], "width" : "9%" }, { "width" : "26%" }, { "width" : "14%", "visible": false }, { "width" : "14%", "visible": false }, { "width" : "14%", "visible": false }, { "width" : "11%" }, { "type" : "percentage", "width" : "12%" }, { "searchable": false, "visible": false }], [ [ 1, "asc" ], [ 5, "asc" ] ], true, aryRowGroup);
  },
  removeRow : function(objId) {
    $("#" + objId + " tr:nth-last-child(2)").remove();
    inputLocal.calculateTotal();
  },
  reset : function() {
    $("#inputs tr").slice($("#inputs tr").index($("#lastRow")) + 1, $("#inputs tr").last().index()).each(function(index) {
      $(this).remove();
    });
  },
  save : function() {
    $("[id^='place_']").each(function(index) {
      $(this).prop("disabled", false);
    });
    return true;
  },
  setIds : function(selectedRow) {
    return $(selectedRow).children("td").first().html();
  },
  validate : function() {
    input.validateLength($("#payoutName_"), 1, false);
    inputLocal.enableButtons();
    $("#inputs tr:nth-last-child(2)").prop("id", "lastRow");
  }
};