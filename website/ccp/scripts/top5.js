"use strict";
$(document).ready(function() {
  inputLocal.rebuildTableForDialog("Nemesis", "Nemesis");
  inputLocal.rebuildTableForDialog("Bullies", "Bully");
  inputLocal.rebuildTableForDialog("LocationsHosted");
  inputLocal.initializeDataTable();
});
const inputLocal = {
  initializeDataTable : function() {
    $(".reportId").each(function(index) {
      const reportId = $(this).val();
      if ("pointsTotalForSeason" == reportId || "pointsAverageForSeason" == reportId) {
        dataTable.initialize("dataTbl" + input.ucwords(reportId), [{ "type" : "name", "width": "70%" }, { "orderSequence": [ "desc", "asc" ], "width": "30%" }], [ [ 1, "desc"], [0, "asc" ] ], false, false, "600px", true);
      } else if ("earningsTotalForSeason" == reportId || "earningsAverageForSeason" == reportId) {
        dataTable.initialize("dataTbl" + input.ucwords(reportId), [{ "type" : "name", "width": "70%" }, { "orderSequence": [ "desc", "asc" ], "type" : "currency", "width": "30%" }], [ [ 1, "desc"], [0, "asc" ] ], false, false, "600px", true);
      } else if ("knockoutsTotalForSeason" == reportId || "knockoutsAverageForSeason" == reportId) {
        dataTable.initialize("dataTbl" + input.ucwords(reportId), [{ "type" : "name", "width": "75%" }, { "orderSequence": [ "desc", "asc" ], "width": "25%" }], [ [ 1, "desc"], [0, "asc" ] ], false, false, "600px", true);
      } else if ("winnersForSeason" == reportId) {
        dataTable.initialize("dataTbl" + input.ucwords(reportId), [{ "type" : "name", "width": "70%" }, { "orderSequence": [ "desc", "asc" ], "width": "30%" }], [ [ 1, "desc"], [0, "asc" ] ], false, false, "600px", true);
      } else if ("finishesForUser" == reportId) {
        dataTable.initialize("dataTbl" + input.ucwords(reportId), [{ "width": "30%" }, { "orderSequence": [ "desc", "asc" ], "width": "40%" }, { "orderSequence": [ "desc", "asc" ], "type": "percentage", "width": "30%" }], [], false, false, "600px", true);
      } else if ("tournamentsPlayedByTypeForUser" == reportId) {
        dataTable.initialize("dataTbl" + input.ucwords(reportId), [{ "width": "25%" }, { "width": "25%" }, { "orderSequence": [ "desc", "asc" ], "width": "17%" }, { "orderSequence": [ "desc", "asc" ], "width": "18%" }, { "orderSequence": [ "desc", "asc" ], "width": "15%" }], [ [4, "desc" ], [1, "asc" ], [0, "asc" ], [2, "desc" ], [3, "asc" ] ], false, false, "600px", true);
      } else if ("nemesisForUser" == reportId) {
        dataTable.initializeBySelector("table[id*='Nemesis']", [{ "type" : "name", }, { "orderSequence": [ "desc", "asc" ], "type" : "number" }], [ [1, "desc" ], [0, "asc" ] ], false, false, "600px", true);
      } else if ("bullyForUser" == reportId) {
        dataTable.initializeBySelector("table[id*='Bully']", [{ "type" : "name" }, { "orderSequence": [ "desc", "asc" ], "type" : "number" }], [ [1, "desc" ], [0, "asc" ] ], false, false, "600px", true);
      }
    });
    $("table[id^='dataTblRank']").each(function(index) {
      const tableId = $(this).prop("id");
      if ("dataTblRankLifetimeTourneys" == tableId) {
        dataTable.initialize(tableId, [null, { "type" : "name" }, { "orderSequence": [ "desc", "asc" ], "type" : "number" }], [ [0, "asc" ] ], false, false, "600px", true);
      } else {
        const reportId = $(this).siblings(".reportId").val();
        dataTable.initialize(tableId, [null, { "type" : "name" }, { "orderSequence": [ "desc", "asc" ], "type" : "earningsTotalForUser" == reportId || "earningsAverageForUser" == reportId || "earningsTotalForSeasonForUser" == reportId ? "currency" : "number" }, { "orderSequence": [ "desc", "asc" ],  "type" : "number" }], [ [0, "asc" ] ], false, false, "600px", true);
        /*const suffix = tableId.replace("dataTblRank", "");
        $(document).on("click", "#dialogRankAll" + suffix + "-header--cancel-btn", function(event) {
          document.getElementById("dialogRankAll" + suffix).close();
          return false;
        });*/
      }
    });
    /*$("table[id^='dataTblNemesis'], table[id^='dataTblBully']").each(function(index) {
      const suffix = tableId.replace("dataTbl", "");
      $(document).on("click", "#dialogRankAll" + suffix + "-header--cancel-btn", function(event) {
        document.getElementById("dialogRankAll" + suffix).close();
        return false;
      });
    });*/
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
  rebuildTableForDialog : function(dialogName, tableName) {
    const queryString = new URLSearchParams(window.location.search);
    //if (queryString.get("navigation") != "Y") {
      // if dialog exists
      if ($("#dialogRankAll" + dialogName).length > 0) {
        // header row + 5 data rows
        if ($("#dataTbl" + tableName + " tr").length > 6) {
          // clone table and change id
          const table = $("#dataTbl" + tableName).clone();
          table.attr("id", "dataTblAll" + tableName);
          table.attr("width", "100%");
          table.css("width", "100%");
          table.find("th").each(function(index) {
            $(this).css("width", "100%");
          });
          $("#dialog" + dialogName).html(table);
          // remove all rows except header and first 5
          $("#dataTbl" + tableName + " tr:gt(5)").remove();
        }
      }
    //}
  },
  // position is [100,100]
  showFullList : function(obj, title, height, width, positionParent, rankValue, userFullName) {
    const re = /\s/gi;
    dataTable.displayHighlightRow("#dataTblRank" + title.replace(re, ""), rankValue, userFullName);
    input.showDialogWithWidth("RankAll" + title.replace(re, ""), height, title, width, {my: "left top", at: "center top", of: "#" + positionParent, collision: "fit"});
  },
  showFullListBullies : function(title, positionParent) {
    input.showDialog("RankAllBullies", 400, title, {my: "left top", at: "center top", of: "#" + positionParent, collision: "fit"});
  },
  showFullListLocationsHosted : function(title, positionParent) {
    input.showDialogWithWidth("LocationsHosted", 400, title, 650, {my: "left top", at: "center top", of: "#" + positionParent, collision: "fit"});
  },
  showFullListNemesis : function(title, positionParent) {
    input.showDialog("RankAllNemesis", 400, title, {my: "left top", at: "center top", of: "#" + positionParent, collision: "fit"});
  }
};