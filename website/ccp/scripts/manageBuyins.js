"use strict";
$(document).ready(function() {
  input.initialize();
});
$(document).on("click", "#buyinCheckAll, #rebuyCheckAll", function(event) {
  const id = this.id.substring(0, this.id.indexOf("CheckAll"));
  input.toggleCheckboxes(id);
  input.countChecked(id);
});
$(document).on("click", "#buyinCheckAll", function(event) {
  inputLocal.postProcessing();
});
$(document).on("click", "#rebuyCheckAll", function(event) {
  inputLocal.toggleRebuy($(this).prop("checked"));
});
$(document).on("click", "#addonCheckAll, #bountyACheckAll, #bountyBCheckAll", function(event) {
  const id = this.id.substring(0, this.id.indexOf("CheckAll"));
  input.toggleCheckboxes(id);
  input.countChecked(id);
});
$(document).on("click", "input[id^='buyin_'], input[id^='rebuy_']", function(event) {
  const id = this.id.substring(0, this.id.indexOf("_"));
  input.toggleCheckAll(id);
});
$(document).on("click", "input[id^='buyin_']", function(event) {
  inputLocal.postProcessing();
});
$(document).on("click", "input[id^='rebuy_']", function(event) {
  const values = $(this).attr("id").split("_");
  $("#rebuyCount_" + values[1]).prop("disabled", !$(this).prop("checked"));
  $("#rebuyCount_" + values[1]).val(($(this).prop("checked") ? 1 : 0));
  input.countChecked("rebuy");
});
$(document).on("keyup paste", "input[id^='rebuyCount_']", function(event) {
  input.validateNumberOnly($(this), event, false);
  if ($(this).val() == "" || parseInt($(this).val()) > parseInt($("#rebuyFlag").val())) {
    $(this).val($(this).data("previousValue"));
  } else {
    const id = $(this).attr("id");
    const values = id.split("_");
    $(this).prop("disabled", ($(this).val() == 0));
    $("#rebuy_" + values[1]).prop("checked", !($(this).val() == 0));
  }
});
$(document).on("click", "input[id^='addon_']", function(event) {
  input.toggleCheckAll("addon");
  input.countChecked("addon");
});
$(document).on("click", "input[id^='bountyA_']", function(event) {
  input.toggleCheckAll("bountyA");
  input.countChecked("bountyA");
});
$(document).on("click", "input[id^='bountyB_']", function(event) {
  input.toggleCheckAll("bountyB");
  input.countChecked("bountyB");
});
const inputLocal = {
  initializeDataTable : function() {
    dataTable.initialize("dataTbl", [ { "type" : "name", "width" : "34%" }, { "orderable": false, "searchable": false, "width" : "12%" }, { "orderable": false, "searchable": false, "width" : "18%" }, { "orderable": false, "searchable": false, "width" : "12%" }, { "orderable": false, "searchable": false, "width" : "12%" }, { "orderable": false, "searchable": false, "width" : "12%" }, { "searchable": false, "visible": false } ], [ [ 0, "asc" ] ]);
  },
  setDefaults : function() {
    input.insertSelectedAfter("Tournament", "tournamentId", "view");
  },
  postProcessing : function() {
    let countNotCheckedPaid = 0;
    // for each paid checkbox
    $('input[id^="buyin_"]').each(function(index) {
      // parse out number from id to use for other objects 
      const id = $(this).attr("id");
      const values = id.split("_");
      // if paid checkbox is not checked
      if (!$(this).prop("checked")) {
        inputLocal.markCheckboxes(true, this, "rebuy", values[1]);
        inputLocal.markCheckboxes(true, this, "addon", values[1]);
        inputLocal.markCheckboxes(false, this, "bountyA", values[1]);
        inputLocal.markCheckboxes(false, this, "bountyB", values[1]);
      }
      inputLocal.disableCheckboxes(true, this, "rebuy", values[1]);
      inputLocal.disableCheckboxes(true, this, "addon", values[1]);
      inputLocal.disableCheckboxes(false, this, "bountyA", values[1]);
      inputLocal.disableCheckboxes(false, this, "bountyB", values[1]);
      // count how many are not checked
      if (!$(this).prop("checked")) {
        countNotCheckedPaid++;
      }
    });
    inputLocal.processAllCheckAll(countNotCheckedPaid);
    input.enableView();
    $("input[id^='rebuy_']").each(function(index) {
      const id = $(this).attr("id");
      const values = id.split("_");
      $("#rebuyCount_" + values[1]).prop("disabled", !$(this).prop("checked"));
      if ($("#rebuyCount_" + values[1]).prop("disabled")) {
        $("#rebuyCount_" + values[1]).val(0);
      }
    });
    $("input[id^='rebuyCount_']").each(function(index) {
      $(this).data("previousValue", $(this).val());
    });
    input.countChecked("buyin");
    input.countChecked("rebuy");
    input.countChecked("addon");
    input.countChecked("bountyA");
    input.countChecked("bountyB");
  },
  disableCheckboxes : function(hasFlag, obj, name, id) {
    // if need to check flag and flag is set or no need to check flag then enable/disable appropriately (rebuy flag is 0 for no rebuy, addon is blank for no addon) 
    if ((hasFlag && $("#" + name + "Flag").val() != "0" && $("#" + name + "Flag").val() != "") || !hasFlag) {
      $("#" + name + "_" + id).prop("disabled", !$(obj).prop("checked"));
    }
  },
  markCheckboxes : function(hasFlag, obj, name, id) {
    // if need to check flag and flag is set or no need to check flag then mark checkbox and check check all checkbox appropriately
    if ((hasFlag && $("#" + name + "Flag").val() != "0") || !hasFlag) {
      $("#" + name + "CheckAll").prop("checked", $(obj).prop("checked"));
      $("#" + name + "_" + id).prop("checked", $(obj).prop("checked"));
    }
  },
  disableCheckboxAll : function(hasFlag, name, countNotCheckedPaid) {
    // if need to check flag and flag is set or no need to check flag (0 for rebuy and "" for addon)
    if ((hasFlag && $("#" + name + "Flag").val() != "0" && $("#" + name + "Flag").val() != "") || !hasFlag) {
      // if checkbox count is same as count passed in then disable check all checkbox
      $("#" + name + "CheckAll").prop("disabled", $('input[id^="' + name + '_"]').length == countNotCheckedPaid);
    }
  },
  processAllCheckAll : function(countNotCheckedPaid) {
    input.toggleCheckAll("buyin");
    input.toggleCheckAll("rebuy");
    input.toggleCheckAll("addon");
    input.toggleCheckAll("bountyA");
    input.toggleCheckAll("bountyB");
    inputLocal.disableCheckboxAll(true, "rebuy", countNotCheckedPaid);
    inputLocal.disableCheckboxAll(true, "addon", countNotCheckedPaid);
    inputLocal.disableCheckboxAll(false, "bountyA", countNotCheckedPaid);
    inputLocal.disableCheckboxAll(false, "bountyB", countNotCheckedPaid);
  },
  toggleRebuy : function(checked) {
    let disabled = false;
    $("input[id^='rebuy_']").each(function(index) {
      if ($(this).prop("disabled")) {
        disabled = true;
      } else {
        const id = $(this).attr("id");
        const values = id.split("_");
        $(this).prop("checked", checked);
        $("#rebuyCount_" + values[1]).prop("disabled", !checked);
        if (0 == $("#rebuyCount_" + values[1]).val()) {
          $("#rebuyCount_" + values[1]).val(1);
        }
        if (!checked) {
          $("#rebuyCount_" + values[1]).val(0);
        }
      }
    });
    // if at least 1 disabled checkbox then uncheck check all checkbox
    if (disabled) {
      $("#" + name + "CheckAll").prop("checked", false);
    }
  },
  buildData : function(objTableId, mode) {
    const objPlayers = $("#ids");
    const objAllPaid = $("#buyinPaid");
    const objAllRebuy = $("#rebuyPaid");
    const objAllRebuyCount = $("#rebuyCount");
    const objAllAddon = $("#addonPaid");
    const objAllBountyA = $("#bountyA");
    const objAllBountyB = $("#bountyB");
    objPlayers.val("");
    objAllPaid.val("");
    objAllRebuy.val("");
    objAllRebuyCount.val("");
    objAllAddon.val("");
    objAllBountyA.val("");
    objAllBountyB.val("");
    // if mode is create or modify then build list of player ids for paid, rebuy, addon, bounty A and bounty B
    if (("create" == mode) || ("modify" == mode)) {
      // for each table row except header
      $("#" + objTableId + " tr").slice("1").each(function(index) {
        const aryInput = $("#dataTbl").DataTable().row(this).data();
        for (let idx = 0; idx < aryInput.length; idx++) {
          const playerId = $(aryInput[aryInput.length - 1]).val();
          objAllPaid.val(objAllPaid.val() + (0 < objAllPaid.val().length ? ", " : "") + $("#buyin_" + playerId).prop("checked"));
          objAllRebuy.val(objAllRebuy.val() + (0 < objAllRebuy.val().length ? ", " : "") + $("#rebuy_" + playerId).prop("checked"));
          objAllRebuyCount.val(objAllRebuyCount.val() + (0 < objAllRebuyCount.val().length ? ", " : "") + $("#rebuyCount_" + playerId).val());
          objAllAddon.val(objAllAddon.val() + (0 < objAllAddon.val().length ? ", " : "") +$("#addon_" + playerId).prop("checked"));
          objAllBountyA.val(objAllBountyA.val() + (0 < objAllBountyA.val().length ? ", " : "") + $("#bountyA_" + playerId).prop("checked"));
          objAllBountyB.val(objAllBountyB.val() + (0 < objAllBountyB.val().length ? ", " : "") + $("#bountyB_" + playerId).prop("checked"));
          objPlayers.val(objPlayers.val() + (0 < objPlayers.val().length ? ", " : "") + playerId);
        }
      });
    }
    $("#mode").val(mode);
  },
  tableRowClick : function(obj) {
    $(obj).removeClass("selected");
  },
  enableSave : function() {
    return false;
  }
};