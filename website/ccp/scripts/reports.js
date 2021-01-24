$(document).ready(function() {
  var dataTableId = reportsInputLocal.initializeDataTable();
  //reportsInputLocal.postProcessing(dataTableId);
});
$(document).on("change", "#year", function(event) {
  var queryString = input.getQueryStringNamed();
  var action = [];
  var found = false;
  for (var i=0; i < queryString.length; i++) {
    if ("year" == queryString[i][0]) {
      queryString[i][1] = $(this).val();
      found = true;
    }
    action[i] = queryString[i].join("=");
  }
  if (!found) {
    action[queryString.length] = "year=" + $(this).val();
  }
  $("#frmReports").attr("action", document.URL.split('?')[0] + "?" + action.join("&"));
  $("#frmReports").submit();
});
var reportsInputLocal = {
  initializeDataTable : function() {
    var dataTableId = null;
    $(".reportId2").each(function(index) {
      var reportId = $(this).val();
      if (reportId == "results") {
        dataTableId = "dataTblTournamentResults";
        if ($("#" + dataTableId).length > 0) {
          $("#" + dataTableId).DataTable({
            "autoWidth": false,
            "columns": [null, {
              "type" : "name"
            }, {
              "orderSequence": [ "desc", "asc" ],
              "type" : "currency"
            }, {
              "orderSequence": [ "desc", "asc" ],
              "type" : "currency"
            }, {
              "orderSequence": [ "desc", "asc" ],
              "type" : "currency"
            }, {
              "orderSequence": [ "desc", "asc" ],
            }, {
              "type" : "name"
            }, { // hide active column
              "searchable": false,
              "visible": false
            }],
            "order": [ [0, "asc" ] ],
            "paging": false,
            "scrollCollapse": true,
            "searching": false
          });
        }
      } else if (reportId == "pointsTotal") {
        dataTableId = "dataTblTotalPoints";
        if ($("#" + dataTableId).length > 0) {
          $("#" + dataTableId).DataTable({
            "autoWidth": false,
            "columns": [{
              "type" : "name"
            }, {
              "orderSequence": [ "desc", "asc" ],
              "type" : "number"
            }, {
              "orderSequence": [ "desc", "asc" ],
              "type" : "number"
            }, {
              "orderSequence": [ "desc", "asc" ],
              "type" : "number"
            }],
            "order": [ [ 1,'desc'], [0, "asc" ] ],
            "paging": false,
            "scrollCollapse": true,
            "searching": false
          });
        }
      } else if (reportId == "earnings") {
        dataTableId = "dataTblEarnings";
        if ($("#" + dataTableId).length > 0) {
          $("#" + dataTableId).DataTable({
            "autoWidth": false,
            "columns": [{
              "type" : "name"
            }, {
              "orderSequence": [ "desc", "asc" ],
              "type" : "currency"
            }, {
              "orderSequence": [ "desc", "asc" ],
              "type" : "currency"
            }, {
              "orderSequence": [ "desc", "asc" ],
              "type" : "currency"
            }, {
              "orderSequence": [ "desc", "asc" ],
              "type" : "number"
            }],
            "order": [ [ 1,'desc'], [0, "asc" ] ],
            "paging": false,
            "scrollCollapse": true,
            "searching": false
          });
        }
      } else if (reportId == "earningsChampionship") {
        dataTableId = "dataTblEarnings\\(Championship\\)";
        if ($("#" + dataTableId).length > 0) {
          $("#" + dataTableId).DataTable({
            "autoWidth": false,
            "columns": [{
              "type" : "name"
            }, {
              "orderSequence": [ "desc", "asc" ],
              "type" : "currency"
            }],
            "order": [ [ 1,'desc'], [0, "asc" ] ],
            "paging": false,
            "scrollCollapse": true,
            "searching": false
          });
        }
      } else if (reportId == "knockouts") {
        dataTableId = "dataTblKnockouts";
        if ($("#" + dataTableId).length > 0) {
          $("#" + dataTableId).DataTable({
            "autoWidth": false,
            "columns": [{
              "type" : "name"
            }, {
              "orderSequence": [ "desc", "asc" ],
              "type" : "number"
            }, {
              "orderSequence": [ "desc", "asc" ],
              "type" : "number"
            }, {
              "orderSequence": [ "desc", "asc" ],
              "type" : "number"
            }, {
              "orderSequence": [ "desc", "asc" ],
              "type" : "number"
            }],
            "order": [ [ 1,'desc'], [0, "asc" ] ],
            "paging": false,
            "scrollCollapse": true,
            "searching": false
          });
        }
      } else if (reportId == "summary") {
        dataTableId = "dataTblSummary";
        if ($("#" + dataTableId).length > 0) {
          $("#" + dataTableId).DataTable({
            "autoWidth": false,
            "columns": [{
              "type" : "name"
            }, {
              "orderSequence": [ "desc", "asc" ],
            }, {
              "orderSequence": [ "desc", "asc" ],
            }, {
              "orderSequence": [ "desc", "asc" ],
            }, {
              "orderSequence": [ "desc", "asc" ],
            }, {
              "orderSequence": [ "desc", "asc" ],
            }, {
            }, {
            }, {
            }, {
            }, {
            }, {
              "orderSequence": [ "desc", "asc" ],
            }, {
              "orderSequence": [ "desc", "asc" ],
            }, {
              "orderSequence": [ "desc", "asc" ],
            }, {
              "orderSequence": [ "desc", "asc" ],
            }, {
              "orderSequence": [ "desc", "asc" ],
            }],
            "order": [ [ 12, "desc"], [0, "asc" ] ],
            "paging": false,
            "scrollCollapse": true,
            "searching": false
          });
        }
      } else if (reportId == "winners") {
        dataTableId = "dataTblWinners";
        if ($("#" + dataTableId).length > 0) {
          $("#" + dataTableId).DataTable({
            "autoWidth": false,
            "columns": [{
              "type" : "name"
            }, {
              "orderSequence": [ "desc", "asc" ],
              "type" : "number"
            }, {
              "orderSequence": [ "desc", "asc" ],
              "type" : "percentage"
            }, {
              "orderSequence": [ "desc", "asc" ],
              "type" : "number"
            }],
            "order": [ [ 1,'desc'], [0, "asc" ] ],
            "paging": false,
            "scrollCollapse": true,
            "searching": false
          });
        }
      } else if (reportId == "finishes") {
        dataTableId = "dataTblFinishes";
        if ($("#" + dataTableId).length > 0) {
          $("#" + dataTableId).DataTable({
            "autoWidth": false,
            "columns": [null, {
              "orderSequence": [ "desc", "asc" ],
            }, {
              "orderSequence": [ "desc", "asc" ],
              "type" : "percentage"
            }],
            "paging": false,
            "scrollCollapse": true,
            "searching": false
          });
        }
      } else if (reportId == "bounties") {
        dataTableId = "dataTblBounties";
        if ($("#" + dataTableId).length > 0) {
          $("#" + dataTableId).DataTable({
            "autoWidth": false,
            "columns": [{
              "sType" : "name"
            }, {
              "orderSequence": [ "desc", "asc" ],
              "type" : "currency"
            }, {
              "orderSequence": [ "desc", "asc" ],
              "type" : "currency"
            }],
            "order": [ [ 1,'desc'], [0, "asc" ] ],
            "paging": false,
            "scrollCollapse": true,
            "searching": false
          });
        }
//      } else if (reportId == "allUsersInfo") {
//        dataTableId = "dataTblInfo";
//        if ($("#" + dataTableId).length > 0) {
//          $("#" + dataTableId).DataTable({
//            "bFilter": false,
//            "bInfo": false,
//            "bPaginate": false,
//            "bDestroy": true,
//            "bRetrieve": true,
//            "bSort": false
//          });
//        }
      } else if (reportId == "locationsHostedCount") {
        $("#dataTblLocationsHostedCount").DataTable({
          "columns" : [null, {
            "type" : "name",
          }, null, null, null, {
            "type" : "number",
          }, null, {
            "orderSequence": [ "desc", "asc" ],
          }, {
            "orderSequence": [ "desc", "asc" ],
            "type" : "number",
          }],
          "order" : [ [8, "desc" ], [1, "asc" ] ],
          "paging": false,
          "scrollCollapse": true,
          "searching": false
        });
      } else if (reportId == "championship") {
        const params = new URLSearchParams(window.location.search);
        /*for (const param of params) {
          console.log(param);
        }*/
        //console.log(params.get("sort"));
        var aryParam = params.get("sort").split(",");
        //console.log(aryParam);
        var aryNew = [];
        aryParam.forEach(function(item, index, array) {
          var aryItem = item.split(" ");
          //console.log(aryItem);
          aryNew[index] = params.get("group") ? parseInt(aryItem) - 1 : aryItem;
        });
        var aryCols = [];
        var colIndex = 0;
        if (!params.get("group")) {
          aryCols[colIndex] = null;
          colIndex++;
        }
        aryCols[colIndex] = {"type" : "name"};
        colIndex++;
        aryCols[colIndex] = null;
        var aryRowGroup = params.get("group") ? null : {
	        startRender: null,
	        endRender: function ( rows, group ) {
	          var nf = new Intl.NumberFormat();
	          var earningsSum = rows.data().pluck(2).reduce( function (a, b) { return parseInt(a.toString().replace(/[$,]/g, '')) + parseInt(b.toString().replace(/[$,]/g, '')); }, 0);
	          var earningsSumFormatted = rows.data().pluck(2).reduce( function (a, b) { return "$" + nf.format(parseInt(a.toString().replace(/[$,]/g, '')) + parseInt(b.toString().replace(/[$,]/g, ''))); }, 0);
	          return $('<tr/>').append('<td colspan="2">Earnings for ' + group + '</td>\n').append('<td class="number positive">' + earningsSumFormatted + '</td>\n<td class="rowGroupSum" style="display:none;">' + earningsSum + '</td>\n');
	        },
	        dataSrc: aryNew[0][0]
	     };
        //console.log(aryNew);
        $("#dataTblChampionship").DataTable({
          "columns" : aryCols,
          "order" : aryNew,
          "paging": false,
          "scrollCollapse": true,
          "searching": false,
          "rowGroup": aryRowGroup
        });
      }
    });
    return dataTableId;
  },
  postProcessing : function(dataTableId) {
  	$("#" + dataTableId).DataTable().rows().every(function(rowIndex, tableCounter, rowCounter) {
  		if (this.cell(rowIndex, 7).data() == "0") {
  			$(this.node()).addClass("inactive");
  		}
  	});
  }
};