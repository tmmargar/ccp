"use strict";
$(document).ready(function() {
  reportsInputLocal.initializeDataTable();
});
$(document).on("change", "#season", function(event) {
  const queryString = new URLSearchParams(window.location.search);
  let action = [];
  let found = false;
  for (let qs of queryString) {
    if ("season" == qs[0]) {
      qs[1] = $(this).val();
      found = true;
    }
    action.push(qs.join("="));
  }
  if (!found) {
    action[action.length] = "season=" + $(this).val();
  }
  $("#frmReports").attr("action", document.URL.split('?')[0] + "?" + action.join("&"));
  $("#frmReports").submit();
});
const reportsInputLocal = {
  initializeDataTable : function() {
    let dataTableId = null;
    $(".reportId2").each(function(index) {
      const reportId = $(this).val();
      if (reportId == "results") {
        dataTableId = "dataTblTournamentResults";
        if ($("#" + dataTableId).length > 0) {
          dataTable.initialize(dataTableId, [null, { "type" : "name" }, { "orderSequence": [ "desc", "asc" ], "type" : "currency" }, { "orderSequence": [ "desc", "asc" ], "type" : "currency" }, { "orderSequence": [ "desc", "asc" ], "type" : "currency" }, { "orderSequence": [ "desc", "asc" ] }, { "type" : "name" }, { "searchable": false, "visible": false }], [[0, "asc" ]], false, false, "600px", true);
        }
      } else if (reportId == "pointsTotal") {
        dataTableId = "dataTblTotalPoints";
        if ($("#" + dataTableId).length > 0) {
          dataTable.initialize(dataTableId, [{ "type" : "name" }, { "orderSequence": [ "desc", "asc" ], "type" : "number" }, { "orderSequence": [ "desc", "asc" ], "type" : "number" }, { "orderSequence": [ "desc", "asc" ], "type" : "number" }], [[ 1,'desc'], [0, "asc" ]], false, false, "600px", true);
        }
      } else if (reportId == "earnings") {
        dataTableId = "dataTblEarnings";
        if ($("#" + dataTableId).length > 0) {
          dataTable.initialize(dataTableId, [{ "type" : "name" }, { "orderSequence": [ "desc", "asc" ], "type" : "currency" }, { "orderSequence": [ "desc", "asc" ], "type" : "currency" }, { "orderSequence": [ "desc", "asc" ], "type" : "number" }, { "orderSequence": [ "desc", "asc" ], "type" : "currency" }], [[ 1,'desc'], [0, "asc" ]], false, false, "600px", true);
        }
      } else if (reportId == "earningsChampionship") {
        dataTableId = "dataTblEarnings\\(Championship\\)";
        if ($("#" + dataTableId).length > 0) {
          dataTable.initialize(dataTableId, [{ "type" : "name" }, { "orderSequence": [ "desc", "asc" ], "type" : "currency" }, { "orderSequence": [ "desc", "asc" ], "type" : "currency" }, { "orderSequence": [ "desc", "asc" ], "type" : "number" }], [[ 1,'desc'], [0, "asc" ]], false, false, "600px", true);
        }
      } else if (reportId == "knockouts") {
        dataTableId = "dataTblKnockouts";
        if ($("#" + dataTableId).length > 0) {
          dataTable.initialize(dataTableId, [{ "type" : "name" }, { "orderSequence": [ "desc", "asc" ], "type" : "number" }, { "orderSequence": [ "desc", "asc" ], "type" : "number" }, { "orderSequence": [ "desc", "asc" ], "type" : "number" }, { "orderSequence": [ "desc", "asc" ], "type" : "number" }], [[ 1,'desc'], [0, "asc" ]], false, false, "600px", true);
        }
      } else if (reportId == "summary") {
        dataTableId = "dataTblSummary";
        if ($("#" + dataTableId).length > 0) {
          dataTable.initialize(dataTableId, [{ "type" : "name" }, { "orderSequence": [ "desc", "asc" ] }, { "orderSequence": [ "desc", "asc" ] }, { "orderSequence": [ "desc", "asc" ] }, { "orderSequence": [ "desc", "asc" ] }, { "orderSequence": [ "desc", "asc" ] }, {}, {}, {}, {}, {}, { "orderSequence": [ "desc", "asc" ] }, { "orderSequence": [ "desc", "asc" ] }, { "orderSequence": [ "desc", "asc" ] }, { "orderSequence": [ "desc", "asc" ] }, { "orderSequence": [ "desc", "asc" ] }], [[ 12, "desc"], [0, "asc"]], false, false, "600px", true);
        }
      } else if (reportId == "winners") {
        dataTableId = "dataTblWinners";
        if ($("#" + dataTableId).length > 0) {
          dataTable.initialize(dataTableId, [{ "type" : "name" }, { "orderSequence": [ "desc", "asc" ], "type" : "number" }, { "orderSequence": [ "desc", "asc" ], "type" : "percentage" }, { "orderSequence": [ "desc", "asc" ], "type" : "number" }], [[ 1,'desc'], [0, "asc"]], false, false, "600px", true);
        }
      } else if (reportId == "finishes") {
        dataTableId = "dataTblFinishes";
        if ($("#" + dataTableId).length > 0) {
          dataTable.initialize(dataTableId, [null, { "orderSequence": [ "desc", "asc" ], }, { "orderSequence": [ "desc", "asc" ], "type" : "percentage" }], [], false, false, "600px", true);
        }
      } else if (reportId == "bounties") {
        dataTableId = "dataTblBounties";
        if ($("#" + dataTableId).length > 0) {
          dataTable.initialize(dataTableId, [{ "sType" : "name" }, { "orderSequence": [ "desc", "asc" ], "type" : "currency" }, { "orderSequence": [ "desc", "asc" ], "type" : "currency" }], [[ 1,'desc'], [0, "asc"]], false, false, "600px", true);
        }
//      } else if (reportId == "locationsHostedCount") {
//        dataTable.initialize(dataTableId, [null, { "type" : "name" }, null, null, null, { "type" : "number" }, null, { "orderSequence": [ "desc", "asc" ] }, { "orderSequence": [ "desc", "asc" ], "type" : "number", }], [[8, "desc" ], [1, "asc" ]]);
      } else if (reportId == "championship") {
        const params = new URLSearchParams(window.location.search);
        // website blocking desc in parameter so passing up and down and replacing here
        const paramsSort = params.get("sort").replace("up", "asc").replace("down", "desc");
        const aryParam = paramsSort.split(",");
        let aryNew = [];
        aryParam.forEach(function(item, index, array) {
          const aryItem = item.split(" ");
          aryNew[index] = params.get("group") ? parseInt(aryItem) - 1 : aryItem;
        });
        let aryCols = [];
        let colIndex = 0;
        if (!params.get("group")) {
          aryCols[colIndex] = null;
          colIndex++;
        }
        aryCols[colIndex] = {"type" : "name"};
        colIndex++;
        aryCols[colIndex] = null;
        const aryRowGroup = params.get("group") ? null : {
	        startRender: null,
	        endRender: function ( rows, group ) {
	          const nf = new Intl.NumberFormat();
	          const earningsSum = rows.data().pluck(2).reduce( function (a, b) { return parseInt(a.toString().replace(/[$,]/g, '')) + parseInt(b.toString().replace(/[$,]/g, '')); }, 0);
	          const earningsSumFormatted = rows.data().pluck(2).reduce( function (a, b) { return "$" + nf.format(parseInt(a.toString().replace(/[$,]/g, '')) + parseInt(b.toString().replace(/[$,]/g, ''))); }, 0);
	          return $('<tr/>').append('<td colspan="2">Earnings for ' + group + '</td>\n').append('<td class="number positive">' + earningsSumFormatted + '</td>\n<td class="rowGroupSum" style="display:none;">' + earningsSum + '</td>\n');
	        },
	        dataSrc: aryNew[0][0]
	      };
	      dataTable.initialize("dataTblChampionship", aryCols, aryNew, false, aryRowGroup, "600px", false, false, true, false);
      }
    });
    return dataTableId;
  }
};