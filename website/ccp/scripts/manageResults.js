"use strict";
$(document).ready(function() {
  input.initialize();
});
$(document).on("change", "#tournamentId", function(event) {
  inputLocal.setTournamentDetails(this.value);
  input.validateLength($("#" + this.id), 1, true);
  inputLocal.enableButtons();
});
$(document).on("change", "[id^='tournamentPlayerId_']", function(event) {
  const aryPlayerId = this.id.split("_");
  inputLocal.customValidation(this.id, '::', aryPlayerId[1]);
  input.validateLength($(this), 1, false);
  const playerValue = $(this).val();
  const previousValue = $(this).data("previousValue");
  // can only select player once
  $("[id^='tournamentPlayerId_']").each(function(index) {
    const aryPlayerId2 = this.id.split("_");
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
  $("#tournamentKnockoutBy_" + aryPlayerId[1]).each(function(index2) {
    const obj = $(this);
    const value = obj.val();
    $(this).find("option").each(function(index2) {
      if (playerValue == $(this).val()) {
        $(this).prop("disabled", true);
        if (value == $(this).val()) {
          obj.val("");
          obj.trigger("change");
        }
      }
      // have to enable previous disabled player
      if ($(this).prop("index") == previousValue) {
        $(this).prop("disabled", false);
      }
    });
  });
  $(this).data("previousValue", this.selectedIndex);
  input.validateLength($(this), 1, false);
  inputLocal.enableButtons();
});
$(document).on("click", "[id^='tournamentRebuy_']", function(event) {
  const id = this.id.split("_");
  $("#tournamentRebuyCount_" + id[1]).prop("disabled", !$(this).prop("checked"));
  $("#tournamentRebuyCount_" + id[1]).val(($(this).prop("checked") ? 1 : 0));
});
$(document).on("keyup paste", "[id^='tournamentRebuyCount_']", function(event) {
  input.validateNumberOnlyGreaterThanEqualToValue($(this), $("#maxRebuys").val(), event);
  const id = this.id.split("_");
  input.validateNumberOnly($(this), event, false);
  if ($(this).val() == "") {
    $(this).val($(this).data("previousValue"));
  } else {
    $(this).prop("disabled", ($(this).val() == 0));
    $("#tournamentRebuy_" + id[1]).prop("checked", !($(this).val() == 0));
  }
});
$(document).on("change", "[id^='tournamentKnockoutBy_']", function(event) {
  const id = this.id.split("_");
  if (1 < $("#tournamentPlace_" + id[1]).val()) {
    input.validateLength($(this), 1, false);
  }
  inputLocal.enableButtons();
});
$(document).on("click", "[id^='create']", function(event) {
  $("#tournamentId").val(0);
});
$(document).on("click", "[id^='addRow']", function(event) {
  inputLocal.addRow("inputs");
  inputLocal.enableButtons();
});
$(document).on("click", "[id^='removeRow']", function(event) {
  inputLocal.removeRow("inputs");
  inputLocal.enableButtons();
});
const inputLocal = {
  addRow : function(objId) {
    let newId;
    // if last row place > 1
    if ($("#" + objId + " tr").last().find("[id^='tournamentPlace_']").val() > 1) {
      // clone last row and adjust index by 1
      const newRow = $("#" + objId + " tr").last().clone();
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
            const idVal = id.split("_");
            newId = (parseInt(idVal[1]) + 1);
            return idVal[0] + "_" + newId;
          },
          "name": function(_, name) {
            const nameVal = name.split("_");
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
      // need this in order for selected value to display properly on new row
      newRow.find("select").each(function(index) {
        $(this).addClass("errors");
        $(this).find("option").eq(0).prop("selected", true);
      });
      // disable previous row player
      const index = $("#tournamentPlayerId_" + (newId - 1)).prop("selectedIndex");
      // if not first item which is None
      if (0 < index) {
        $("#tournamentPlayerId_" + newId + " option").eq(index).prop("disabled", true);
      }
      // disable all players if last row (1st place)
      const obj = $("#" + objId + " tr").last().find("[id^='tournamentKnockoutBy_']");
      // should only be 1
      const id = obj[0].id;
      const idValues = id.split("_");
      if (1 == $("#tournamentPlace_" + idValues[1]).val()) {
        obj.find("option").each(function(index) {
          if (index > 0) {
            $(this).prop("disabled", true);
          }
        });
        obj.removeClass("errors");
      }
    }
  },
  customValidation : function(objId, delim, index) {
    // player value is id, rebuyPaid, rebuyCount, addonPaid (100::N::0::N)
    // id::rebuy count::addon amount (100:1:0)
    const values = $("#" + objId).val().split(delim);
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
  customValidationSave : function(objId, e) {
    const objMode = $("#mode");
    const objPlayers = $("#ids");
    objPlayers.val("");
    for (let x=1; x <= $("#" + objId).find("tr").length - 1; x++) {
      const objPlayer = $("#tournamentPlayerId_" + x);
      const playerId = objPlayer.val().split('::')[0];
      if (("create" == objMode.val()) || ("modify" == objMode.val())) {
        if (0 < objPlayers.val().length) {
          objPlayers.val(objPlayers.val() + ", ");
        }
        objPlayers.val(objPlayers.val() + playerId);
      }
    }
    $("#mode").val("save" + $("#mode").val());
  },
  delete : function(event) {
    inputLocal.setTournamentPlayerIds();
    return false;
  },
  enableButtons : function() {
    // if no tournament selected disable view, modify and delete buttons otherwise enable them
    const result = $("#tournamentId").val() == "0";
    $("#view").prop("disabled", result);
    $("[id^='delete']").prop("disabled", result);
    $("#go").prop("disabled", result);
    if (result) {
      $("[id^='modify']").prop("disabled", true);
    } else {
      const text = $("#tournamentId :selected").text();
      const position = text.lastIndexOf("/") + 1;
      $("[id^='modify']").prop("disabled", text.substring(position, position + 1) == 0);
    }
    // if last row place is 1 then disable add row otherwise enable it
    $("[id^='addRow']").prop("disabled", $("#inputs tr").last().find("[id^='tournamentPlace_']").val() == 1);
    // if only 2 rows (header + 1 data) then disable remove row otherwise enable it
    $("[id^='removeRow']").prop("disabled", $("#inputs tr").length == 2);
    let disabled = false;
    $("select[id^='tournamentPlayerId_']").each(function(index) {
      if ("" == this.value) {
        disabled = true;
      }
    });
    if (!disabled) {
      $("[id^='tournamentKnockoutBy_']").each(function(index) {
        const id = this.id.split("_");
        if (1 < $("#tournamentPlace_" + id[1]).val()) {
          if ("" == this.value) {
            disabled = true;
          }
        }
      });
    }
    $("[id^='save']").prop("disabled", disabled);
    return disabled;
  },
  enableSave : function() {
    return inputLocal.enableButtons();
  },
  initializeDataTable : function() {
    if ($("#mode").val() == "view" || $("#mode").val() == "delete") {
      dataTable.initialize("dataTbl", [ { "type" : "name", "width" : "30%" }, { "width" : "10%" }, { "width" : "10%" }, { "width" : "10%" }, { "width" : "10%" }, { "type" : "name", "width" : "30%" }, { "searchable": false, "visible": false } ], [ [ 4, "asc" ] ]);
    } else if ($("#mode").val() == "create" || $("#mode").val() == "modify") {
      dataTable.initialize("inputs", null, [], false);
    }
  },
  modify : function(event) {
    inputLocal.setTournamentPlayerIds();
    return false;
  },
  postProcessing : function() {
    $("[id^='tournamentRebuy_']").each(function(index) {
      $(this).prop("disabled", $("#maxRebuys").val() == 0);
      if ($("#mode").val() == "create") {
        $(this).prop("checked", false);
      }
    });
    $("[id^='tournamentRebuyCount_']").each(function(index) {
      $(this).prop("disabled", $("#maxRebuys").val() == 0);
      if ($("#mode").val() == "create") {
        this.value = "0";
      }
    });
    $("[id^='tournamentAddon_']").each(function(index) {
      $(this).prop("disabled", $("#addonAmount").val() == 0);
      if ($("#mode").val() == "create") {
        $(this).prop("checked", false);
      }
    });
    $("[id^='tournamentPlayerId_']").each(function(index) {
      const aryPlayerId = this.id.split("_");
      const playerValue = $(this).val();
      if ("" != playerValue) {
        // cannot knockout yourself
        $("#tournamentKnockoutBy_" + aryPlayerId[1] + " option").each(function(index2) {
          if (playerValue == $(this).val()) {
            $(this).prop("disabled", true);
          }
        });
      }
      // can only select player once
      $("[id^='tournamentPlayerId_']").each(function(index3) {
        const aryPlayerId2 = this.id.split("_");
        if (aryPlayerId[1] != aryPlayerId2[1]) {
          $(this).find("option").each(function(index4) {
            if (playerValue == $(this).val()) {
              $(this).prop("disabled", true);
            }
          });
        }
      });
      // can only select knockout once
      $("[id^='tournamentKnockoutBy_']").each(function(index5) {
        const aryKnockoutId = this.id.split("_");
        if (parseInt(aryPlayerId[1]) < parseInt(aryKnockoutId[1])) {
          $(this).find("option").each(function(index6) {
            if (playerValue == $(this).val()) {
              $(this).prop("disabled", true);
            }
          });
        }
      });
    });
    $("[id^='tournamentPlayerId_']").each(function(index) {
      $(this).data("previousValue", this.selectedIndex);
    });
    $("[id^='tournamentRebuy_']").each(function(index) {
      const id = $(this).attr("id");
      const values = id.split("_");
      $("#tournamentRebuyCount_" + values[1]).prop("disabled", !$(this).prop("checked"));
    });
    $("[id^='tournamentRebuyCount_']").each(function(index) {
      $(this).data("previousValue", $(this).val());
    });
  },
  removeRow : function(objId) {
    // enable player selected in row being removed
    const idx = $("#" + objId + " tr").last().find("[id^='tournamentPlayerId_']")[0].selectedIndex;
    // subtract 1 for zero index and 1 for previous row
    $("#tournamentPlayerId_" + ($("#" + objId + " tr").length - 2) + " option").eq(" + idx + ").prop("disabled", false);
    $("#" + objId + " tr").last().remove();
  },
  save : function(event) {
    inputLocal.setTournamentPlayerIds();
    inputLocal.customValidationSave("inputs", event);
    $("[id^='tournamentRebuy_'], [id^='tournamentRebuyCount_'], [id^='tournamentAddon_'], [id^='tournamentPlace_']").each(function(index) {
      $(this).prop("disabled", false);
    });
  },
  setDefaults : function() {
    inputLocal.setTournamentDetails($("#tournamentId").val());
    input.insertSelectedBefore("Tournament", "tournamentId", "mode");
  },
  setTournamentDetails : function(value) {
    // id::rebuy count::addon amount (100:1:0)
    if (value != undefined) {
      const aryId = value.split("::");
      if (aryId.length > 1) {
        $("#maxRebuys").val(aryId[1]);
        $("#addonAmount").val(aryId[2]);
      }
    }
  },
  setTournamentPlayerIds : function() {
    let tournamentPlayerIds = "";
    const rows = dataTable.getRowsData($("#dataTbl").DataTable());
    for (let idx = 0; idx < rows.length; idx++) {
      tournamentPlayerIds += $(rows[idx][6]).val() + ", ";
    }
    tournamentPlayerIds = tournamentPlayerIds.substring(0, tournamentPlayerIds.length - 2);
    $("#ids").val(tournamentPlayerIds);

  },
  tableRowClick : function(obj) {
    $(obj).removeClass("selected");
  },
  validate : function() {
    input.validateLength($("#tournamentId"), 1, false);
    input.validateLength($("#tournamentPlayerId_1"), 1, false);
    input.validateLength($("#tournamentKnockoutBy_1"), 1, false);
    inputLocal.enableButtons();
  }
};