"use strict";
$(document).ready(function() {
  inputLocal.rebuildTableForDialog("Nemesis");
  inputLocal.rebuildTableForDialog("Bully");
  inputLocal.rebuildTableForDialog("LocationsHosted");
  inputLocal.initializeDataTable();
});
const inputLocal = {
  initializeDataTable : function() {
    $(".reportId").each(function(index) {
      const reportId = $(this).val();
      if ("pointsTotalForSeason" == reportId || "pointsAverageForSeason" == reportId) {
        dataTable.initialize("dataTbl" + input.ucwords(reportId), [{ "type" : "name", "width": "70%" }, { "orderSequence": [ "desc", "asc" ], "width": "30%" }], [ [ 1, "desc"], [0, "asc" ] ], false);
      } else if ("earningsTotalForSeason" == reportId || "earningsAverageForSeason" == reportId) {
        dataTable.initialize("dataTbl" + input.ucwords(reportId), [{ "type" : "name", "width": "70%" }, { "orderSequence": [ "desc", "asc" ], "type" : "currency", "width": "30%" }], [ [ 1, "desc"], [0, "asc" ] ], false);
      } else if ("knockoutsTotalForSeason" == reportId || "knockoutsAverageForSeason" == reportId) {
        dataTable.initialize("dataTbl" + input.ucwords(reportId), [{ "type" : "name", "width": "75%" }, { "orderSequence": [ "desc", "asc" ], "width": "25%" }], [ [ 1, "desc"], [0, "asc" ] ], false);
      } else if ("winnersForSeason" == reportId) {
        dataTable.initialize("dataTbl" + input.ucwords(reportId), [{ "type" : "name", "width": "70%" }, { "orderSequence": [ "desc", "asc" ], "width": "30%" }], [ [ 1, "desc"], [0, "asc" ] ], false);
      } else if ("finishesForUser" == reportId) {
        dataTable.initialize("dataTbl" + input.ucwords(reportId), [{ "width": "30%" }, { "orderSequence": [ "desc", "asc" ], "width": "40%" }, { "orderSequence": [ "desc", "asc" ], "type": "percentage", "width": "30%" }], [], false, false, "200px");
      } else if ("tournamentsPlayedByTypeForUser" == reportId) {
        dataTable.initialize("dataTbl" + input.ucwords(reportId), [{ "width": "25%" }, { "width": "25%" }, { "orderSequence": [ "desc", "asc" ], "width": "17%" }, { "orderSequence": [ "desc", "asc" ], "width": "18%" }, { "orderSequence": [ "desc", "asc" ], "width": "15%" }], [ [4, "desc" ], [1, "asc" ], [0, "asc" ], [2, "desc" ], [3, "asc" ] ], false);
      } else if ("nemesisForUser" == reportId) {
        dataTable.initializeBySelector("table[id*='Nemesis']", [{ "type" : "name", }, { "orderSequence": [ "desc", "asc" ], "type" : "number" }], [ [1, "desc" ], [0, "asc" ] ], false, false, "");
      } else if ("bullyForUser" == reportId) {
        dataTable.initializeBySelector("table[id*='Bully']", [{ "type" : "name" }, { "orderSequence": [ "desc", "asc" ], "type" : "number" }], [ [1, "desc" ], [0, "asc" ] ], false, false, "");
      }
    });
    $("table[id^='dataTblRank']").each(function(index) {
      const tableId = $(this).prop("id");
      if ("dataTblRankTournamentsPlayed" == tableId) {
        dataTable.initialize(tableId, [null, { "type" : "name" }, { "orderSequence": [ "desc", "asc" ], "type" : "number" }], [ [0, "asc" ] ], false, false, "");
      } else {
        const reportId = $(this).siblings(".reportId").val();
        dataTable.initialize(tableId, [null, { "type" : "name" }, { "orderSequence": [ "desc", "asc" ], "type" : "earningsTotalForUser" == reportId || "earningsAverageForUser" == reportId || "earningsTotalForSeasonForUser" == reportId ? "currency" : "number" }, { "orderSequence": [ "desc", "asc" ],  "type" : "number" }], [ [0, "asc" ] ], false, false, "");
      }
    });
    let previousValue = "";
    // for ranking tables only
    $("table[id^='dataTblRank'] tr td:first-child").each(function(index) {
      // if values matches previous then do not show rank since same as previous row
      if ($(this).html() == previousValue) {
        $(this).html("");
      } else {
        previousValue = $(this).html();
      }
    });
  },
  rebuildTableForDialog : function(name) {
    const queryString = new URLSearchParams(window.location.search);
    if (queryString.get("navigation") != "Y") {
      // if dialog exists
      if ($("#dialog" + name).length > 0) {
        // header row + 5 data rows
        if ($("#dataTbl" + name + " tr").length > 6) {
          // clone table and change id
          const table = $("#dataTbl" + name).clone();
          table.attr("id", "dataTblAll" + name);
          table.attr("width", "100%");
          table.css("width", "100%");
          table.find("th").each(function(index) {
            $(this).css("width", "100%");
          });
          $("#dialog" + name).html(table);
          // remove all rows except header and first 5
          $("#dataTbl" + name + " tr:gt(5)").remove();
        }
      }
    }
  },
  resetDialog : function(title) {
    const re = /\s/gi;
    const objTable = $("#dataTblRank" + title.replace(re, "")).DataTable();
    objTable.order([[0,"asc"]]).draw();
  },
  // position is [100,100]
  showFullList : function(title, height, width, positionParent) {
    const re = /\s/gi;
    input.showDialogWithWidth("RankAll" + title.replace(re, ""), height, title, width, {my: "left top", at: "center top", of: "#" + positionParent, collision: "fit"});
  },
  showFullListBully : function(title, positionParent) {
    input.showDialog("Bully", 400, title, {my: "left top", at: "center top", of: "#" + positionParent, collision: "fit"});
  },
  showFullListLocationsHosted : function(title, positionParent) {
    input.showDialogWithWidth("LocationsHosted", 400, title, 650, {my: "left top", at: "center top", of: "#" + positionParent, collision: "fit"});
  },
  showFullListNemesis : function(title, positionParent) {
    input.showDialog("Nemesis", 400, title, {my: "left top", at: "center top", of: "#" + positionParent, collision: "fit"});
  }
};