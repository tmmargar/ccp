"use strict";
$(document).ready(function() {
  input.initialize();
});
$(document).on("click", "#save", function(e) {
  inputLocal.customValidation(e);
});
$(document).on("change", "#tournamentPlayerId", function(event) {
  input.validateLength($(this), 1, false);
  inputLocal.enableButtons();
  const playerValue = $(this).val();
  const previousValue = $(this).data("previousValue");
  // cannot knockout self
  $("[id^='tournamentKnockoutBy']").each(function(index) {
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
});
$(document).on("change", "#tournamentKnockoutBy", function(event) {
  input.validateLength($(this), 1, false);
  inputLocal.enableButtons();
});
const inputLocal = {
  customValidation : function(e) {
    $("#tournamentPlayerName").val($("#tournamentPlayerId :selected").text());
    $("#tournamentKnockoutByName").val($("#tournamentKnockoutBy :selected").text());
    // none plus last 2 players
    if ($("#tournamentPlayerId option").length == 3) {
      // if first player selected set other player
      const option = $("#tournamentPlayerId option").eq($("#tournamentPlayerId :selected").index() == 1 ? 2 : 1);
      $("#tournamentPlayerNameTemp").val(option.text());
      $("#tournamentPlayerIdTemp").val(option.val());
    }
  },
  enableButtons : function() {
    $("#save").prop("disabled", ($("#tournamentPlayerId").length > 0 && (($("#tournamentPlayerId").val() == "") || ($("#tournamentKnockoutBy").val() == ""))));
  },
  reset : function() {
    $("#tournamentKnockoutBy option").each(function(index2) {
      $(this).prop("disabled", false);
    });
    $("#tournamentPlayerId").val("");
    $("#tournamentKnockoutBy").val("");
  },
  setDefaults : function() {
    $("#mode").val("view");
  },
  validate : function() {
    input.validateLength($("#tournamentPlayerId"), 1, false);
    input.validateLength($("#tournamentKnockoutBy"), 1, false);
    inputLocal.enableButtons();
  }
};