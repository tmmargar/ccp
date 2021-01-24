$(document).ready(function() {
  inputLocal.initializeDataTable();
  inputLocal.setDefaults();
  inputLocal.initialValidation();
  inputLocal.postProcessing();
});
$(document).on("change", "#tournamentId", function(event) {
  inputLocal.enableView();
});
$(document).on("click", "#dataTbl tr", function(event) {
  // override scripts.js to remove selected row class that highlights row
  if ($(this).hasClass("selected")) {
    $(this).removeClass("selected");
  }
});
$(document).on("click", "#buyinCheckAll", function(event) {
  inputLocal.toggleCheckboxes("buyin");
  inputLocal.postProcessing();
  input.countChecked("buyin");
});
$(document).on("click", "#rebuyCheckAll", function(event) {
  inputLocal.toggleCheckboxes("rebuy");
  inputLocal.toggleRebuy($(this).prop("checked"));
  input.countChecked("rebuy");
});
$(document).on("click", "#addonCheckAll", function(event) {
  inputLocal.toggleCheckboxes("addon");
  input.countChecked("addon");
});
$(document).on("click", "#bountyACheckAll", function(event) {
  inputLocal.toggleCheckboxes("bountyA");
  input.countChecked("bountyA");
});
$(document).on("click", "#bountyBCheckAll", function(event) {
  inputLocal.toggleCheckboxes("bountyB");
  input.countChecked("bountyB");
});
$(document).on("click", "input[id^='buyin_']", function(event) {
  inputLocal.toggleCheckAll("buyin");
  inputLocal.postProcessing();
});
$(document).on("click", "input[id^='rebuy_']", function(event) {
  inputLocal.toggleCheckAll("rebuy");
  var id = $(this).attr("id");
  var values = id.split("_");
  $("#rebuyCount_" + values[1]).prop("disabled", !$(this).prop("checked"));
  $("#rebuyCount_" + values[1]).val(($(this).prop("checked") ? 1 : 0));
  input.countChecked("rebuy");
});
$(document).on("keyup paste", "input[id^='rebuyCount_']", function(event) {
  input.validateNumberOnly($(this), event, false);
  if ($(this).val() == "" || parseInt($(this).val()) > parseInt($("#rebuyFlag").val())) {
    $(this).val($(this).data("previousValue"));
  } else {
    var id = $(this).attr("id");
    var values = id.split("_");
    $(this).prop("disabled", ($(this).val() == 0));
    $("#rebuy_" + values[1]).prop("checked", !($(this).val() == 0));
  }
});
$(document).on("click", "input[id^='addon_']", function(event) {
  inputLocal.toggleCheckAll("addon");
  input.countChecked("addon");
});
$(document).on("click", "input[id^='bountyA_']", function(event) {
  inputLocal.toggleCheckAll("bountyA");
  input.countChecked("bountyA");
});
$(document).on("click", "input[id^='bountyB_']", function(event) {
  inputLocal.toggleCheckAll("bountyB");
  input.countChecked("bountyB");
});
var inputLocal = {
  initializeDataTable : function() {
    $("#dataTbl").DataTable({
      "autoWidth": false,
      "columns" : [ {
        "type" : "name",
        "width" : "34%"
      }, {
        "orderable": false,
        "searchable": false,
        "width" : "12%"
      }, {
        "orderable": false,
        "searchable": false,
        "width" : "18%"
      }, {
        "orderable": false,
        "searchable": false,
        "width" : "12%"
      }, {
        "orderable": false,
        "searchable": false,
        "width" : "12%"
      }, {
        "orderable": false,
        "searchable": false,
        "width" : "12%"
      }, {
        "searchable": false,
        "visible": false
      } ],
      "order" : [ [ 0, "asc" ] ],
      "paging": false,
      "scrollCollapse": true,
      "searching": false
    });
  },
  setDefaults : function() {
    $("<p>Tournament selected: " + $("#tournamentId :selected").text() + "</p>").insertAfter($("#view"));
  },
  initialValidation : function() {
  },
  postProcessing : function() {
    var countNotCheckedPaid = 0;
    // for each paid checkbox
    $('input[id^="buyin_"]').each(function(index) {
      // parse out number from id to use for other objects 
      var id = $(this).attr("id");
      var values = id.split("_");
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
    inputLocal.enableView();
    $("input[id^='rebuy_']").each(function(index) {
      var id = $(this).attr("id");
      var values = id.split("_");
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
  enableView : function() {
    if ($("#tournamentId").val() != -1) {
      $("#view").prop("disabled", false);
    } else {
      $("#view").prop("disabled", true);
    }
  },
  disableCheckboxes : function(hasFlag, obj, name, id) {
    // if need to check flag and flag is set or no need to check flag then enable/disable appropriately (rebuy flag is 0 for no rebuy, addon is blank for no addon) 
    if ((hasFlag && $("#" + name + "Flag").val() != "0" && $("#" + name + "Flag").val() != "") || !hasFlag) {
      $("#" + name + "_" + id).prop("disabled", !$(obj).prop("checked"));
    }
  },
  buildData : function(name, mode) {
    var objPlayers = $("#tournamentPlayerIds");
    var objAllPaid = $("#buyinPaid");
    var objAllRebuy = $("#rebuyPaid");
    var objAllRebuyCount = $("#rebuyCount");
    var objAllAddon = $("#addonPaid");
    var objAllBountyA = $("#bountyA");
    var objAllBountyB = $("#bountyB");
    objPlayers.val("");
    objAllPaid.val("");
    objAllRebuy.val("");
    objAllRebuyCount.val("");
    objAllAddon.val("");
    objAllBountyA.val("");
    objAllBountyB.val("");
    // if mode is create of modify then build list of player ids for paid, rebuy, addon, bounty A and bounty B
    if (("savecreate" == mode) || ("savemodify" == mode)) {
      // for each table row except header
      $("#dataTbl tr:gt(0)").each(function(index) {
        var dataTbl = $("#dataTbl").dataTable();
        var aryInput = dataTbl.fnGetData(this);
        for (var idx = 0; idx < aryInput.length; idx++) {
          var aryData = aryInput[idx].split(" ")
          for (var ix = 0; ix < aryData.length; ix++) {
            var aryValues = aryData[ix].split("=")
            if (aryValues[0] == "id") {
              var aryId = aryValues[1].split("_");
              var name = aryId[0].substring(1, aryId[0].length);
              if (name == "rowPlayerId") {
                var playerId = aryId[1].substring(0, aryId[1].length - 1);
                if (0 < objAllPaid.val().length) {
                  objAllPaid.val(objAllPaid.val() + ", ");
                }
                objAllPaid.val(objAllPaid.val() + $("#buyin_" + playerId).prop("checked"));
                if (0 < objAllRebuy.val().length) {
                  objAllRebuy.val(objAllRebuy.val() + ", ");
                }
                objAllRebuy.val(objAllRebuy.val() + $("#rebuy_" + playerId).prop("checked"));
                if (0 < objAllRebuyCount.val().length) {
                  objAllRebuyCount.val(objAllRebuyCount.val() + ", ");
                }
                objAllRebuyCount.val(objAllRebuyCount.val() + $("#rebuyCount_" + playerId).val());
                if (0 < objAllAddon.val().length) {
                  objAllAddon.val(objAllAddon.val() + ", ");
                }
                objAllAddon.val(objAllAddon.val() + $("#addon_" + playerId).prop("checked"));
                if (0 < objAllBountyA.val().length) {
                  objAllBountyA.val(objAllBountyA.val() + ", ");
                }
                objAllBountyA.val(objAllBountyA.val() + $("#bountyA_" + playerId).prop("checked"));
                if (0 < objAllBountyB.val().length) {
                  objAllBountyB.val(objAllBountyB.val() + ", ");
                }
                objAllBountyB.val(objAllBountyB.val() + $("#bountyB_" + playerId).prop("checked"));
                if (0 < objPlayers.val().length) {
                  objPlayers.val(objPlayers.val() + ", ");
                }
                objPlayers.val(objPlayers.val() + playerId);
                break;
              }
            }
          }
        }
      });
    }
    $("#mode").val(mode);
  },
  markCheckboxes : function(hasFlag, obj, name, id) {
    // if need to check flag and flag is set or no need to check flag then mark checkbox and check check all checkbox appropriately
    if ((hasFlag && $("#" + name + "Flag").val() != "0") || !hasFlag) {
      $("#" + name + "CheckAll").prop("checked", $(obj).prop("checked"));
      $("#" + name + "_" + id).prop("checked", $(obj).prop("checked"));
    }
  },
  toggleCheckboxes : function(name) {
    var disabled = false;
    // for each checkbox
    $("input[id^='" + name + "_']").each(function(index) {
      // if enabled then set checked state to same as check all checkbox
      if (!$(this).prop("disabled")) {
        var checked = $("#" + name + "CheckAll").prop("checked");
        $(this).prop("checked", checked);
    	  //$(this).trigger("click");
      } else {
        disabled = true;
      }
    });
    // if at least 1 disabled checkbox then uncheck check all checkbox
    /*if (disabled) {
      $("#" + name + "CheckAll").prop("checked", false);
    }*/
  },
  toggleCheckAll : function(name) {
    // if all checkboxes are checked then mark check all checkbox
    if ($("input[id^='" + name + "_']:checked").length == $("input[id^='" + name + "_']").length) {
      $("#" + name + "CheckAll").prop("checked", true);
    } else {
      $("#" + name + "CheckAll").prop("checked", false);
    }
  },
  disableCheckboxAll : function(hasFlag, name, countNotCheckedPaid) {
    // if need to check flag and flag is set or no need to check flag (0 for rebuy and "" for addon)
    if ((hasFlag && $("#" + name + "Flag").val() != "0" && $("#" + name + "Flag").val() != "") || !hasFlag) {
      // if checkbox count is same as count passed in then disable check all checkbox
      if ($('input[id^="' + name + '_"]').length == countNotCheckedPaid) {
        $("#" + name + "CheckAll").prop("disabled", true);
      } else {
        $("#" + name + "CheckAll").prop("disabled", false);
      }
    }
  },
  processAllCheckAll : function(countNotCheckedPaid) {
    inputLocal.toggleCheckAll("buyin");
    inputLocal.toggleCheckAll("rebuy");
    inputLocal.toggleCheckAll("addon");
    inputLocal.toggleCheckAll("bountyA");
    inputLocal.toggleCheckAll("bountyB");
    inputLocal.disableCheckboxAll(true, "rebuy", countNotCheckedPaid);
    inputLocal.disableCheckboxAll(true, "addon", countNotCheckedPaid);
    inputLocal.disableCheckboxAll(false, "bountyA", countNotCheckedPaid);
    inputLocal.disableCheckboxAll(false, "bountyB", countNotCheckedPaid);
  },
  toggleRebuy : function(checked) {
    var disabled = false;
    $("input[id^='rebuy_']").each(function(index) {
      if ($(this).prop("disabled")) {
        disabled = true;
      } else {
        var id = $(this).attr("id");
        var values = id.split("_");
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
  }
};