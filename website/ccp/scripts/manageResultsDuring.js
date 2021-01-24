$(document).ready(function() {
  inputLocal.setDefaults();
  inputLocal.initialValidation();
  inputLocal.postProcessing();
  inputLocal.enableButtons();
});
$(document).on("click", "#save", function(e) {
  inputLocal.customValidation(e);
});
$(document).on("click", "#reset", function(e) {
  $("#tournamentKnockoutBy").find("option").each(function(index2) {
    $(this).prop("disabled", false);
  });
  $("#tournamentPlayerId").val("");
  $("#tournamentKnockoutBy").val("");
  inputLocal.setDefaults();
  inputLocal.initialValidation();
  inputLocal.postProcessing();
  inputLocal.enableButtons();
});
$(document).on("change", "#bountyA", function(event) {
  input.validateLength($("#bountyA"), 1, false);
  inputLocal.enableButtons();
  var bountyAValue = $(this).val();
  var previousValue = $(this).data("previousValue");
  $("#bountyB").find("option").each(function(index2) {
    if ($("#bountyA").val() != "" && bountyAValue == $(this).val()) {
      $(this).prop("disabled", true);
      if ($("#bountyB").val() == $(this).val()) {
        $("#bountyB").val("");            
      }
    }
    // have to enable previous disabled player
    if ($(this).prop("index") == previousValue) {
      $(this).prop("disabled", false);
    }
  });
  $(this).data("previousValue", this.selectedIndex);
});
$(document).on("change", "#bountyB", function(event) {
  input.validateLength($("#bountyB"), 1, false);
  inputLocal.enableButtons();
  var bountyBValue = $(this).val();
  var previousValue = $(this).data("previousValue");
  $("#bountyA").find("option").each(function(index2) {
    if ($("#bountyB").val() != "" && bountyBValue == $(this).val()) {
      $(this).prop("disabled", true);
      if ($("#bountyA").val() == $(this).val()) {
        $("#bountyA").val("");            
      }
    }
    // have to enable previous disabled player
    if ($(this).prop("index") == previousValue) {
      $(this).prop("disabled", false);
    }
  });
  $(this).data("previousValue", this.selectedIndex);
});
$(document).on("change", "#tournamentPlayerId", function(event) {
  input.validateLength($("#tournamentPlayerId"), 1, false);
  inputLocal.enableButtons();
  var aryPlayerId = this.id.split("_");
  var playerValue = $(this).val();
  var previousValue = $(this).data("previousValue");
  // cannot knockout self
  $("select[id^='tournamentKnockoutBy']").each(function(index) {
    var obj = $(this);
    var value = obj.val();
    $(this).find("option").each(function(index2) {
      if (playerValue == $(this).val()) {
        $(this).prop("disabled", true);
        if (value == $(this).val()) {
          obj.val("");            
        }
      }
      // have to enable previous disabled player
      if ($(this).prop("index") == previousValue) {
        $(this).prop("disabled", false);
      }
    });
  });
  $(this).data("previousValue", this.selectedIndex);
});
$(document).on("change", "#tournamentKnockoutBy", function(event) {
  input.validateLength($("#tournamentKnockoutBy"), 1, false);
  inputLocal.enableButtons();
});
var inputLocal = {
  enableButtons : function() {
    if (($("#bountyA").length > 0 && (($("#bountyA").val() == "") || ($("#bountyB").val() == ""))) ||
        ($("#tournamentPlayerId").length > 0 && (($("#tournamentPlayerId").val() == "") || ($("#tournamentKnockoutBy").val() == "")))) {
      $("#save").prop("disabled", true);
    } else {
      $("#save").prop("disabled", false);
    }
  },
  setDefaults : function() {
  },
  initialValidation : function() {
    input.validateLength($("#tournamentPlayerId"), 1, false);
    input.validateLength($("#tournamentKnockoutBy"), 1, false);
  },
  postProcessing : function() {
  },
  customValidation : function(e) {
    $("#bountyAName").val($("#bountyA :selected").text());
    $("#bountyBName").val($("#bountyB :selected").text());
    $("#tournamentPlayerName").val($("#tournamentPlayerId :selected").text());
    $("#tournamentKnockoutByName").val($("#tournamentKnockoutBy :selected").text());
    // none plus last 2 players
    if ($("#tournamentPlayerId option").length == 3) {
      // if first player selected set other player
      if ($("#tournamentPlayerId :selected").index() == 1) {
        var option = $("#tournamentPlayerId option:eq(2)");
        $("#tournamentPlayerNameTemp").val(option.text());
        $("#tournamentPlayerIdTemp").val(option.val());
      } else {
        var option = $("#tournamentPlayerId option:eq(1)");
        $("#tournamentPlayerNameTemp").val(option.text());
        $("#tournamentPlayerIdTemp").val(option.val());
      }
    }
    input.setFormValues(["mode"], ["save" + $("#mode").val()]);
  }
};