"use strict";
import { dataTable, display, input } from "./import.js";
export const reportsInputLocal = {
  initializeDataTable : function() {
    let dataTableId = null;
    document.querySelectorAll(".reportId2").forEach(obj => {
      const reportId = obj.value;
      if (reportId == "results") {
        dataTableId = "dataTblTournamentResults";
        if (document.querySelector("#" + dataTableId)) {
          dataTable.initialize({tableId: dataTableId, aryColumns: [null, { "type" : "name" }, { "orderSequence": [ "desc", "asc" ] }, { "orderSequence": [ "desc", "asc" ] }, { "orderSequence": [ "desc", "asc" ] }, { "orderSequence": [ "desc", "asc" ] }, { "type" : "name" }, { "searchable": false, "visible": false }], aryOrder: [[0, "asc" ]], aryRowGroup: false, autoWidth: false, paging: false, scrollCollapse: true, scrollResize: true, scrollY: "600px", searching: true });
        }
      } else if (reportId == "pointsTotal") {
        dataTableId = "dataTblTotalPoints";
        if (document.querySelector("#" + dataTableId)) {
          dataTable.initialize({tableId: dataTableId, aryColumns: [{ "type" : "name" }, { "orderSequence": [ "desc", "asc" ] }, { "orderSequence": [ "desc", "asc" ] }, { "orderSequence": [ "desc", "asc" ] }], aryOrder: [[1, "desc"], [0, "asc"]], aryRowGroup: false, autoWidth: false, paging: false, scrollCollapse: true, scrollResize: true, scrollY: "600px", searching: true });
        }
      } else if (reportId == "earnings") {
        dataTableId = "dataTblEarnings";
        if (document.querySelector("#" + dataTableId)) {
          dataTable.initialize({tableId: dataTableId, aryColumns: [{ "type" : "name" }, { "orderSequence": [ "desc", "asc" ] }, { "orderSequence": [ "desc", "asc" ] }, { "orderSequence": [ "desc", "asc" ] }, { "orderSequence": [ "desc", "asc" ] }], aryOrder: [[1, "desc"], [0, "asc"]], aryRowGroup: false, autoWidth: false, paging: false, scrollCollapse: true, scrollResize: true, scrollY: "600px", searching: true });
        }
      } else if (reportId == "earningsChampionship") {
        dataTableId = "dataTblEarnings\\(Championship\\)";
        if (document.querySelector("#" + dataTableId)) {
          dataTable.initialize({tableId: dataTableId, aryColumns: [{ "type" : "name" }, { "orderSequence": [ "desc", "asc" ] }, { "orderSequence": [ "desc", "asc" ] }, { "orderSequence": [ "desc", "asc" ] }], aryOrder: [[1, "desc"], [0, "asc"]], aryRowGroup: false, autoWidth: false, paging: false, scrollCollapse: true, scrollResize: true, scrollY: "600px", searching: true });
        }
      } else if (reportId == "knockouts") {
        dataTableId = "dataTblKnockouts";
        if (document.querySelector("#" + dataTableId)) {
          dataTable.initialize({tableId: dataTableId, aryColumns: [{ "type" : "name" }, { "orderSequence": [ "desc", "asc" ] }, { "orderSequence": [ "desc", "asc" ] }, { "orderSequence": [ "desc", "asc" ] }, { "orderSequence": [ "desc", "asc" ] }], aryOrder: [[1, "desc"], [0, "asc"]], aryRowGroup: false, autoWidth: false, paging: false, scrollCollapse: true, scrollResize: true, scrollY: "600px", searching: true });
        }
      } else if (reportId == "summary") {
        dataTableId = "dataTblSummary";
        if (document.querySelector("#" + dataTableId)) {
          dataTable.initialize({tableId: dataTableId, aryColumns: [{ "type" : "name" }, { "orderSequence": [ "desc", "asc" ] }, { "orderSequence": [ "desc", "asc" ] }, { "orderSequence": [ "desc", "asc" ] }, { "orderSequence": [ "desc", "asc" ] }, { "orderSequence": [ "desc", "asc" ] }, {}, {}, {}, {}, {}, {}, { "orderSequence": [ "desc", "asc" ] }, { "orderSequence": [ "desc", "asc" ] }, { "orderSequence": [ "desc", "asc" ] }], aryOrder: [[12, "desc"], [0, "asc"]], aryRowGroup: false, autoWidth: false, paging: false, scrollCollapse: true, scrollResize: true, scrollY: "600px", searching: true });
        }
      } else if (reportId == "winners") {
        dataTableId = "dataTblWinners";
        if (document.querySelector("#" + dataTableId)) {
          dataTable.initialize({tableId: dataTableId, aryColumns: [{ "type" : "name" }, { "orderSequence": [ "desc", "asc" ] }, { "orderSequence": [ "desc", "asc" ] }, { "orderSequence": [ "desc", "asc" ] }], aryOrder: [[1, "desc"], [0, "asc"]], aryRowGroup: false, autoWidth: false, paging: false, scrollCollapse: true, scrollResize: true, scrollY: "600px", searching: true });
        }
      } else if (reportId == "finishes") {
        dataTableId = "dataTblFinishes";
        if (document.querySelector("#" + dataTableId)) {
          dataTable.initialize({tableId: dataTableId, aryColumns: [null, { "orderSequence": [ "desc", "asc" ], }, { "orderSequence": [ "desc", "asc" ] }], aryOrder: [], aryRowGroup: false, autoWidth: false, paging: false, scrollCollapse: true, scrollResize: true, scrollY: "600px", searching: true });
        }
      } else if (reportId == "championship") {
        dataTableId = "dataTblChampionship";
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
	          const objRow = document.createElement("tr");
	          const objColumn = document.createElement("td");
	          objColumn.classList.add("bold");
	          objColumn.colSpan = 2;
	          objColumn.innerHTML = "Earnings for " + group;
	          objRow.appendChild(objColumn);
	          const objColumn2 = document.createElement("td");
	          objColumn2.classList.add("number");
	          objColumn2.classList.add("positive");
	          objColumn2.innerHTML = earningsSumFormatted;
	          objColumn2.style.fontWeight = "900";
	          objRow.appendChild(objColumn2);
	          const objColumn3 = document.createElement("td");
	          objColumn3.classList.add("rowGroupSum");
	          objColumn3.style.display = "none";
	          objColumn3.innerHTML = earningsSum;
	          objRow.appendChild(objColumn3);
	          return objRow;
	        },
	        dataSrc: aryNew[0][0]
	      };
	      dataTable.initialize({tableId: dataTableId, aryColumns: aryCols, aryOrder: aryNew, aryRowGroup: aryRowGroup, autoWidth: false, paging: false, scrollCollapse: true, scrollResize: true, scrollY: "600px", searching: true });
      } else if (reportId == "fees") {
        dataTableId = "dataTblFees";
        if (document.querySelector("#" + dataTableId)) {
          dataTable.initialize({tableId: dataTableId, aryColumns: [null, null, null, null], aryOrder: [[1, "desc"]], aryRowGroup: false, autoWidth: false, paging: false, scrollCollapse: true, scrollResize: true, scrollY: "600px", searching: true });
          dataTable.initialize({tableId: "dataTblFeeDetail", aryColumns: [{visible: false}, {visible: false}, { "type": "name" }, { "orderSequence": [ "desc", "asc" ] }, { "orderSequence": [ "desc", "asc" ], visible: false }, null], aryOrder: [[5, "desc"], [2, "asc"]], aryRowGroup: false, autoWidth: false, paging: false, scrollCollapse: true, scrollResize: true, scrollY: "600px", searching: true });
        }
      }
    });
    return dataTableId;
  },
  showFeeDetail : function(seasonId) {
    // search matches entire value
    const regex = '\\b' + seasonId + '\\b';
    $("#dataTblFeeDetail").DataTable().columns(0).search(regex, true, false).draw();
    const rowsData = $("#dataTblFeeDetail").DataTable().rows({search:'applied'}).data();
    document.querySelector("#dialogFeeDetailSpan").innerText = " - " + rowsData[0][1] + " " + rowsData[0][4];
    input.showDialog({name: "FeeDetail"});
  }
};
let documentReadyCallback = () => {
  reportsInputLocal.initializeDataTable();
};
if (document.readyState === "complete" || (document.readyState !== "loading" && !document.documentElement.doScroll)) {
  documentReadyCallback();
} else {
  document.addEventListener("DOMContentLoaded", documentReadyCallback);
}
document.addEventListener("change", (event) => {
  if (event.target && event.target.id.includes("season")) {
    const queryString = new URLSearchParams(window.location.search);
    let action = [];
    let found = false;
    for (let qs of queryString) {
      if ("season" == qs[0]) {
        qs[1] = event.target.value;
        found = true;
      }
      action.push(qs.join("="));
    }
    if (!found) {
      action[action.length] = "season=" + event.target.value;
    }
    document.querySelector("#frmReports").setAttribute("action", document.URL.split('?')[0] + "?" + action.join("&"));
    document.querySelector("#frmReports").submit();
  }
});
