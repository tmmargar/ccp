$(document).ready(function() {
  inputLocal.initializeDataTable();
  inputLocal.setDefaults();
  inputLocal.initialValidation();
  inputLocal.postProcessing();
  inputLocal.enableButtons();
});
$(document).on("click", "#dataTbl tr", function(event) {
  if ($(this).hasClass("selected")) {
    $(this).removeClass("selected");
  }
});
$(document).on("click", "#inputs tr", function(event) {
  if ($(this).hasClass("selected")) {
    $(this).removeClass("selected");
  }
});
$(document).on("click", "#create", function(event) {
  input.setFormValues([ "mode", "tournamentId" ], [ "create", "" ]);
});
$(document).on("click", "#modify", function(event) {
  inputLocal.setTournamentPlayerIds();
  input.setFormValues([ "mode" ], [ "modify" ]);
});
$(document).on("click", "#delete", function(event) {
  inputLocal.setTournamentPlayerIds();
  input.setFormValues([ "mode" ], [ "delete" ]);
});
$(document).on("click", "#confirmDelete", function(event) {
  input.setFormValues([ "mode" ], [ "confirm" ]);
});
$(document).on("click", "#cancel", function(event) {
  input.setFormValues([ "mode" ], [ "view" ]);
});
$(document).on("click", "#save", function(e) {
  inputLocal.customValidationSave("inputs", e);
  $("input[id^='tournamentRebuy_']").each(function(index) {
    $(this).prop("disabled", false);
  });
  $("input[id^='tournamentRebuyCount_']").each(function(index) {
    $(this).prop("disabled", false);
  });
  $("input[id^='tournamentAddon_']").each(function(index) {
    $(this).prop("disabled", false);
  });
  $("input[id^='tournamentPlace_']").each(function(index) {
    $(this).prop("disabled", false);
  });
});
$(document).on("click", "#reset", function(event) {
  input.setFormValues([ "mode" ], [ $("#mode").val() ]);
});
$(document).on("change", "#tournamentId", function(event) {
  inputLocal.setTournamentDetails(this.value);
  input.validateLength($("#" + this.id), 1, true);
  inputLocal.enableButtons();
});
$(document).on("change", "#BountyA", function(event) {
  var bountyAValue = $(this).val();
  var previousValue = $(this).data("previousValue");
  $("#BountyB").find("option").each(function(index2) {
    if ($("#BountyA").val() != "" && bountyAValue == $(this).val()) {
      $(this).prop("disabled", true);
      if ($("#BountyB").val() == $(this).val()) {
        $("#BountyB").val("");            
      }
    }
    // have to enable previous disabled player
    if ($(this).prop("index") == previousValue) {
      $(this).prop("disabled", false);
    }
  });
  $(this).data("previousValue", this.selectedIndex);
});
$(document).on("change", "#BountyB", function(event) {
  var bountyBValue = $(this).val();
  var previousValue = $(this).data("previousValue");
  $("#BountyA").find("option").each(function(index2) {
    if ($("#BountyB").val() != "" && bountyBValue == $(this).val()) {
      $(this).prop("disabled", true);
      if ($("#BountyA").val() == $(this).val()) {
        $("#BountyA").val("");            
      }
    }
    // have to enable previous disabled player
    if ($(this).prop("index") == previousValue) {
      $(this).prop("disabled", false);
    }
  });
  $(this).data("previousValue", this.selectedIndex);
});
$(document).on("change", "select[id^='tournamentPlayerId_']", function(event) {
  var aryPlayerId = this.id.split("_");
  inputLocal.customValidation(this.id, '::', aryPlayerId[1]);
  input.validateLength($(this), 1, false);
  var playerValue = $(this).val();
  var previousValue = $(this).data("previousValue");
  // can only select player once
  $("select[id^='tournamentPlayerId_']").each(function(index) {
    var aryPlayerId2 = this.id.split("_");
    if (aryPlayerId[1] != aryPlayerId2[1]) {
      $(this).find("option").each(function(index2) {
        if ("" != playerValue) {
          if (playerValue == $(this).val()) {
            $(this).prop("disabled", true);
          }
        }
        // have to enable previous disabled player
        if ($(this).prop("index") == previousValue) {
          $(this).prop("disabled", false);
        }
      });
    }
  });
  // cannot knockout yourself
  $("#tournamentKnockoutBy_" + aryPlayerId[1] + " option").each(function(index2) {
    if ("" != playerValue && playerValue == $(this).val()) {
      $(this).prop("disabled", true);
//      $(this).val("");
      this.selectedIndex = -1;
    }
    // have to enable previous disabled player
    if ($(this).prop("index") == previousValue) {
      $(this).prop("disabled", false);
    }
  });
  $(this).data("previousValue", this.selectedIndex);
  input.validateLength($(this), 1, false);
  inputLocal.enableButtons();
});
$(document).on("click", "input[id^='tournamentRebuy_']", function(event) {
  var id = this.id.split("_");
//  if ($(this).prop("checked")) {
//    if ($("#tournamentRebuyCount_" + id[1]).val() == 0) {
//      $("#tournamentRebuyCount_" + id[1]).val(1);
//    }
//  } else {
//    $("#tournamentRebuyCount_" + id[1]).val(0);
//  }
  $("#tournamentRebuyCount_" + id[1]).prop("disabled", !$(this).prop("checked"));
  $("#tournamentRebuyCount_" + id[1]).val(($(this).prop("checked") ? 1 : 0));
});
$(document).on("keyup paste", "input[id^='tournamentRebuyCount_']", function(event) {
  input.validateNumberOnlyLessThanEqualToValue($(this), $("#maxRebuys").val(), event);
  var id = this.id.split("_");
//  if ((this.value.length > 0) && (this.value != 0)) {
//    $("#tournamentRebuy_" + id[1]).prop("checked", true);
//  } else {
//    $("#tournamentRebuy_" + id[1]).prop("checked", false);
//  }
  input.validateNumberOnly($(this), event, false);
  if ($(this).val() == "") {
    $(this).val($(this).data("previousValue"));
  } else {
//    var id = $(this).attr("id");
//    var values = id.split("_");
    $(this).prop("disabled", ($(this).val() == 0));
    $("#tournamentRebuy_" + id[1]).prop("checked", !($(this).val() == 0));
  }
});
$(document).on("change", "select[id^='tournamentKnockoutBy_']", function(event) {
  var id = this.id.split("_");
  if (1 < $("#tournamentPlace_" + id[1]).val()) {
    input.validateLength($(this), 1, false);
  }
  inputLocal.enableButtons();
});
$(document).on("click", "#addRow", function(event) {
  inputLocal.addRow("inputs");
  inputLocal.enableButtons();
});
$(document).on("click", "#removeRow", function(event) {
  inputLocal.removeRow("inputs");
  inputLocal.enableButtons();
});
var inputLocal = {
  enableButtons : function() {
    // if no tournament selected disable view, modify and delete buttons otherwise enable them
    if ($("#tournamentId").val() == "") {
      $("#view").prop("disabled", true);
      $("#modify").prop("disabled", true);
      $("#delete").prop("disabled", true);
      $("#go").prop("disabled", true);
    } else {
      $("#view").prop("disabled", false);
      var text = $("#tournamentId :selected").text();
      var position = text.lastIndexOf("/") + 1;
      if (text.substring(position, position + 1) == 0) {
        $("#modify").prop("disabled", true);
      } else {
        $("#modify").prop("disabled", false);
      }
      $("#delete").prop("disabled", false);
      $("#go").prop("disabled", false);
    }
    // if last row place is 1 then disable add row otherwise enable it
    if ($("#inputs tr:last").find("input[id^='tournamentPlace_']").val() == 1) {
      $("#addRow").prop("disabled", true);
    } else {
      $("#addRow").prop("disabled", false);
    }
    // if only 2 rows (header + 1 data) then disable remove row otherwise enable it
    if ($("#inputs tr").length == 2) {
      $("#removeRow").prop("disabled", true);
    } else {
      $("#removeRow").prop("disabled", false);
    }
    var disabled = false;
    $("select[id^='tournamentPlayerId_']").each(function(index) {
      if ("" == this.value) {
        disabled = true;
      }
    });
    $("select[id^='tournamentKnockoutBy_']").each(function(index) {
      var id = this.id.split("_");
      if (1 < $("#tournamentPlace_" + id[1]).val()) {
        if ("" == this.value) {
          disabled = true;
        }
      }
    });
    if (disabled) {
      $("#save").prop("disabled", true);
    } else {
      $("#save").prop("disabled", false);
    }
  },
  setTournamentPlayerIds : function() {
    var tournamentPlayerIds = "";
    // all rows except header
    var selectedRows = $("#dataTbl tr:gt(0)");
    for (var idx = 0; idx < selectedRows.length; idx++) {
      tournamentPlayerIds += $($("#dataTbl").dataTable().fnGetData(idx, 6)).val() + ", ";
    }
    tournamentPlayerIds = tournamentPlayerIds.substring(0, tournamentPlayerIds.length - 2);
    $("#tournamentPlayerIds").val(tournamentPlayerIds);

  },
  initializeDataTable : function() {
    if ($("#mode").val() == "view" || $("#mode").val() == "delete") {
      $("#dataTbl").DataTable({
        "autoWidth": false,
        "columns" : [ {
          "type" : "name",
          "width" : "30%"
        }, {
          "width" : "10%"
        }, {
          "width" : "10%"
        }, {
          "width" : "10%"
        }, {
          "width" : "10%"
        }, {
          "type" : "name",
          "width" : "30%"
        }, {
          "searchable": false,
          "visible": false
        } ],
        "order" : [ [ 4, "asc" ] ],
        "paging": false,
        "scrollCollapse": true,
        "searching": false
      });
    } else if ($("#mode").val() == "create" || $("#mode").val() == "modify") {
      $("#inputs").dataTable({
        "paging": false,
        "scrollCollapse": true,
        "searching": false
      });
    }
  },
  setDefaults : function() {
    inputLocal.setTournamentDetails($("#tournamentId").val());
    var obj;
    if ($("#go").length > 0) {
      obj = $("#go");
    } else {
      obj = $("#create");
    }
    $("<p>Tournament selected: " + $("#tournamentId :selected").text() + "</p>").insertAfter(obj);
  },
  initialValidation : function() {
    input.validateLength($("#tournamentId"), 1, false);
    input.validateLength($("#tournamentPlayerId_1"), 1, false);
    input.validateLength($("#tournamentKnockoutBy_1"), 1, false);
  },
  postProcessing : function() {
    $("input[id^='tournamentRebuy_']").each(function(index) {
      if ($("#maxRebuys").val() == 0) {
        $(this).prop("disabled", true);
      } else {
        $(this).prop("disabled", false);
      }
      if ($("#mode").val() == "create") {
        $(this).prop("checked", false);
      }
    });
    $("input[id^='tournamentRebuyCount_']").each(function(index) {
      if ($("#maxRebuys").val() == 0) {
        $(this).prop("disabled", true);
      } else {
        $(this).prop("disabled", false);
      }
      if ($("#mode").val() == "create") {
        this.value = "0";
      }
    });
    $("input[id^='tournamentAddon_']").each(function(index) {
      if ($("#addonAmount").val() == 0) {
        $(this).prop("disabled", true);
      } else {
        $(this).prop("disabled", false);
      }
      if ($("#mode").val() == "create") {
        $(this).prop("checked", false);
      }
    });
    $("select[id^='tournamentPlayerId_']").each(function(index) {
      var aryPlayerId = this.id.split("_");
      var playerValue = $(this).val();
      if ("" != playerValue) {
        // cannot knockout yourself
        $("#tournamentKnockoutBy_" + aryPlayerId[1] + " option").each(function(index2) {
          if (playerValue == $(this).val()) {
            $(this).prop("disabled", true);
          }
        });
      }
      // can only select player once
      $("select[id^='tournamentPlayerId_']").each(function(index3) {
        var aryPlayerId2 = this.id.split("_");
        if (aryPlayerId[1] != aryPlayerId2[1]) {
          $(this).find("option").each(function(index4) {
            if (playerValue == $(this).val()) {
              $(this).prop("disabled", true);
            }
          });
        }
      });
      // can only select knockout once
      $("select[id^='tournamentKnockoutBy_']").each(function(index5) {
        var aryKnockoutId = this.id.split("_");
        if (parseInt(aryPlayerId[1]) < parseInt(aryKnockoutId[1])) {
          $(this).find("option").each(function(index6) {
            if (playerValue == $(this).val()) {
              $(this).prop("disabled", true);
            }
          });
        }
      });
    });
    $("select[id^='tournamentPlayerId_']").each(function(index) {
      $(this).data("previousValue", this.selectedIndex);
    });
    $("input[id^='tournamentRebuy_']").each(function(index) {
      var id = $(this).attr("id");
      var values = id.split("_");
      $("#tournamentRebuyCount_" + values[1]).prop("disabled", !$(this).prop("checked"));
    });
    $("input[id^='tournamentRebuyCount_']").each(function(index) {
      $(this).data("previousValue", $(this).val());
    });
  },
  customValidation : function(objId, delim, index) {
    // player value is id, rebuyPaid, rebuyCount, addonPaid (100::N::0::N)
    // id::rebuy count::addon amount (100:1:0)
    var values = $("#" + objId).val().split(delim);
    if (values[1] == "Y") {
      $("#" + "tournamentRebuy_" + index).prop("checked", true);
      $("#" + "tournamentRebuyCount_" + index).prop("disabled", false);
      $("#" + "tournamentRebuyCount_" + index).val(values[2]);
    } else {
      $("#" + "tournamentRebuy_" + index).prop("checked", false);
      $("#" + "tournamentRebuyCount_" + index).val(0);
      if ($("#tournamentId :selected").val().split("::")[1] == 0) {
	    $("#" + "tournamentRebuy_" + index).prop("disabled", true);
	    $("#" + "tournamentRebuyCount_" + index).prop("disabled", true);
      }
    }
    if (values[3] == "Y") {
      $("#" + "tournamentAddon_" + index).prop("checked", true);
    } else {
      $("#" + "tournamentAddon_" + index).prop("checked", false);
      if ($("#tournamentId :selected").val().split("::")[2] == 0) {
        $("#" + "tournamentAddon_" + index).prop("disabled", true);
      }
    }
  },
  addRow : function(objId) {
    var newId;
    // if last row place > 1
    if ($("#" + objId + " tr:last input[id^='tournamentPlace_']").val() > 1) {
      // clone last row and adjust index by 1
      var newRow = $("#" + objId + " tr:last").clone();
      newRow.toggleClass("odd even");
      newRow.find(":input").each(function(index) {
        $(this).attr({
          "disabled": function(_, disabled) {
            if (this.id.indexOf("tournamentRebuyCount_") != -1) {
              return true;
            }
            return disabled;
          },
          "id": function(_, id) {
            var idVal = id.split("_");
            newId = (parseInt(idVal[1]) + 1);
            return idVal[0] + "_" + newId;
          },
          "name": function(_, name) {
            var nameVal = name.split("_");
            return nameVal[0] + "_" + (parseInt(nameVal[1]) + 1);
          }
        });
        $(this).prop({
          "checked": function(_, checked) {
            return false;
          },
          "value": function(_, value) {
            if (this.id.indexOf("tournamentPlace_") != -1) {
              return value - 1;
            } else if (value == 0 || this.id.indexOf("tournamentRebuyCount_") != -1) {
              return 0;
            } else if (!$(this).is(":checkbox")) {
              return "";
            }
          }
        });
      }).end().appendTo("#" + objId);
      // disable previous row player
      var index = $("#tournamentPlayerId_" + (newId - 1)).prop("selectedIndex");
      // if not first item which is None
      if (0 < index) {
        $("#tournamentPlayerId_" + newId + " option:eq(" + index + ")").prop("disabled", true);
      }
      // disable all players if last row (1st place)
      var obj = $("#" + objId + " tr:last select[id^='tournamentKnockoutBy_']");
      // should only be 1
      var id = obj[0].id;
      var idValues = id.split("_");
      if (1 == $("#tournamentPlace_" + idValues[1]).val()) {
    		obj.find("option").each(function(index) {
          if (index > 0) {
            $(this).prop("disabled", true);
          }
    		});
    		obj.removeClass("errors");
  		}
    }
    //input.validateLength($("#" + objId), 1, false);
  },
  removeRow : function(objId) {
    // enable player selected in row being removed
    var idx = $("#" + objId + " tr:last select[id^='tournamentPlayerId_']")[0].selectedIndex;
    // subtract 1 for zero index and 1 for previous row
    $("#tournamentPlayerId_" + ($("#" + objId + " tr").length - 2) + " option:eq(" + idx + ")").prop("disabled", false);
    $("#" + objId + " tr:last").remove();
  },
  customValidationSave : function(objId, e) {
    var objMode = $("#mode");
    var objPlayers = $("#tournamentPlayerIds");
    objPlayers.val("");
    for (var x=1; x <= $("#" + objId).find("tr").length - 1; x++) {
      var objPlayer = $("#tournamentPlayerId_" + x);
      var playerId = objPlayer.val().split('::')[0];
      if (("create" == objMode.val()) || ("modify" == objMode.val())) {
        if (0 < objPlayers.val().length) {
          objPlayers.val(objPlayers.val() + ", ");
        }
        objPlayers.val(objPlayers.val() + playerId);
      }
    }
    input.setFormValues(["mode"], ["save" + $("#mode").val()]);
  },
  setTournamentDetails : function(value) {
    // id::rebuy count::addon amount (100:1:0)
    if (value != undefined) {
      var aryId = value.split("::");
      if (aryId.length > 1) {
        $("#maxRebuys").val(aryId[1]);
        $("#addonAmount").val(aryId[2]);
      }
    }
  }
};