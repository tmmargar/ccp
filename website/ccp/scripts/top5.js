$(document).ready(function() {
  inputLocal.setDefaults();
  inputLocal.initialValidation();
  inputLocal.postProcessing();
  inputLocal.rebuildTableForDialog("Nemesis");
  inputLocal.rebuildTableForDialog("Bully");
  inputLocal.rebuildTableForDialog("LocationsHosted");
  inputLocal.initializeDataTable();
});
$(document).on("click", "#dataTbl tr", function(event) {
  // override scripts.js to remove selected row class that highlights row
  if ($(this).hasClass("row_selected")) {
    $(this).removeClass("row_selected");
  }
});
var inputLocal = {
  initializeDataTable : function() {
    $(".reportId").each(function(index) {
      var reportId = $(this).val();
      if ("pointsTotalForSeason" == reportId || "pointsAverageForSeason" == reportId) {
        $("#dataTbl" + input.ucwords(reportId)).DataTable({
          "autoWidth": false,
          "columns" : [{
            "type" : "name",
            "width": "70%"
          }, {
            "orderSequence": [ "desc", "asc" ],
            "width": "30%"
          }],
          "order" : [ [ 1, "desc"], [0, "asc" ] ],
          "paging": false,
          "scrollCollapse": true,
          "searching": false
        });
      } else if ("earningsTotalForSeason" == reportId || "earningsAverageForSeason" == reportId) {
        $("#dataTbl" + input.ucwords(reportId)).DataTable({
          "autoWidth": false,
          "columns" : [{
            "type" : "name",
            "width": "70%"
          }, {
            "orderSequence": [ "desc", "asc" ],
            "type" : "currency",
            "width": "30%"
          }],
          "order" : [ [ 1, "desc"], [0, "asc" ] ],
          "paging": false,
          "scrollCollapse": true,
          "searching": false
        });
      } else if ("knockoutsTotalForSeason" == reportId || "knockoutsAverageForSeason" == reportId) {
        $("#dataTbl" + input.ucwords(reportId)).DataTable({
          "autoWidth": false,
          "columns" : [{
            "type" : "name",
            "width": "75%"
          }, {
            "orderSequence": [ "desc", "asc" ],
            "width": "25%"
          }],
          "order" : [ [ 1, "desc"], [0, "asc" ] ],
          "paging": false,
          "scrollCollapse": true,
          "searching": false
        });
      } else if ("winnersForSeason" == reportId) {
        $("#dataTbl" + input.ucwords(reportId)).DataTable({
          "autoWidth": false,
          "columns" : [{
            "type" : "name",
            "width": "70%"
          }, {
            "orderSequence": [ "desc", "asc" ],
            "width": "30%"
          }],
          "order" : [ [ 1, "desc"], [0, "asc" ] ],
          "paging": false,
          "scrollCollapse": true,
          "searching": false
        });
      } else if ("finishesForUser" == reportId) {
        $("#dataTbl" + input.ucwords(reportId)).DataTable({
          "autoWidth": false,
          "columns" : [{
            "width": "30%"
          }, {
            "orderSequence": [ "desc", "asc" ], "width": "40%"
          }, {
            "orderSequence": [ "desc", "asc" ], "type": "percentage", "width": "30%"
          }],
          "paging": false,
          "scrollCollapse": true,
          "searching": false
        });
      } else if ("tournamentsPlayedByTypeForUser" == reportId) {
        $("#dataTbl" + input.ucwords(reportId)).DataTable({
          "autoWidth": false,
          "columns" : [{
            "width": "25%"
          }, {
            "width": "25%"
          }, {
            "orderSequence": [ "desc", "asc" ],
            "width": "17%"
          }, {
            "orderSequence": [ "desc", "asc" ],
            "width": "18%"
          }, {
            "orderSequence": [ "desc", "asc" ],
            "width": "15%"
          }],
          "order" : [ [4, "desc" ], [1, "asc" ], [0, "asc" ], [2, "desc" ], [3, "asc" ] ],
          "paging": false,
          "scrollCollapse": true,
          "searching": false
        });
      } else if ("nemesisForUser" == reportId) {
        //$("#dataTblNemesis").DataTable({
        $("table[id*='Nemesis']").DataTable({
          "columns" : [{
            "type" : "name",
          }, {
            "orderSequence": [ "desc", "asc" ], 
            "type" : "number"
          }],
          "info": false,
          "order" : [ [1, "desc" ], [0, "asc" ] ],
          "paging": false,
          "scrollCollapse": true,
          "searching": false
        });
      } else if ("bullyForUser" == reportId) {
        //$("#dataTblBully").DataTable({
        $("table[id*='Bully']").DataTable({
          "columns" : [{
            "type" : "name",
          }, {
            "orderSequence": [ "desc", "asc" ],
            "type" : "number"
          }],
          "info": false,
          "order" : [ [1, "desc" ], [0, "asc" ] ],
          "paging": false,
          "scrollCollapse": true,
          "searching": false
        });
//      } else if ("locationsHostedCount" == reportId) {
//        $("#dataTblLocationsHosted").DataTable({
//          "columns" : [null, {
//            "type" : "name",
//          }, null, null, null, {
//            "type" : "number",
//          }, null, null, {
//            "type" : "number",
//          }],
//          "order" : [ [8, "desc" ], [1, "asc" ] ],
//          "paging": false,
//          "scrollCollapse": true,
//          "searching": false
//        });
      }
    });
    $("table[id^='dataTblRank']").each(function(index) {
      var tableId = $(this).prop("id");
      if ("dataTblRankTournamentsPlayed" == tableId) {
        $(this).DataTable({
          "columns" : [null, {
            "type" : "name",
          }, {
            "orderSequence": [ "desc", "asc" ], 
            "type" : "number"
          }],
          "order" : [ [0, "asc" ] ],
          "paging": false,
          "scrollCollapse": true,
          "searching": false
        });
      } else {
        var reportId = $($(this).parents()[0]).siblings(".reportId").val();
        $(this).DataTable({
          "columns" : [null, {
            "type" : "name",
          }, {
            "orderSequence": [ "desc", "asc" ], 
            "type" : "earningsTotalForUser" == reportId || "earningsAverageForUser" == reportId || "earningsTotalForSeasonForUser" == reportId ? "currency" : "number"
          }, {
            "orderSequence": [ "desc", "asc" ], 
            "type" : "number"
          }],
  //        "columnDefs": [
  //          { "orderSequence": [ "desc", "asc", ], "targets": [ 3 ] }
  //        ],
          "order" : [ [0, "asc" ] ],
          "paging": false,
          "scrollCollapse": true,
          "searching": false
        });
      }
    });
    var previousValue = "";
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
  setDefaults : function() {
  },
  initialValidation : function() {
  },
  postProcessing : function() {
  },
  rebuildTableForDialog : function(name) {
    if ($.getQueryStringByName("navigation") != "Y") {
      // if dialog exists
      if ($("#dialog" + name).length > 0) {
        // header row + 5 data rows
        if ($("#dataTbl" + name + " tr").length > 6) {
          // clone table and change id
          var table = $("#dataTbl" + name).clone();
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
  showFullListNemesis : function(title, positionParent) {
//    input.showDialog("Nemesis", 400, title, ['middle','bottom']);
    input.showDialog("Nemesis", 400, title, {my: "left top", at: "center top", of: "#" + positionParent, collision: "fit"});
  },
  showFullListBully : function(title, positionParent) {
//    input.showDialog("Bully", 400, title, ['middle','bottom']);
    input.showDialog("Bully", 400, title, {my: "left top", at: "center top", of: "#" + positionParent, collision: "fit"});
  },
  showFullListLocationsHosted : function(title, positionParent) {
//    input.showDialogWithWidth("LocationsHosted", 400, title, 650, ['middle','bottom']);
    input.showDialogWithWidth("LocationsHosted", 400, title, 650, {my: "left top", at: "center top", of: "#" + positionParent, collision: "fit"});
  },
  // position is [100,100]
  showFullList : function(title, height, width, positionParent) {
    //inputLocal.resetDialog(title);
    var re = /\s/gi;
//    input.showDialogWithWidth("RankAll" + title.replace(re, ""), height, title, width, ['middle','bottom']);
    input.showDialogWithWidth("RankAll" + title.replace(re, ""), height, title, width, {my: "left top", at: "center top", of: "#" + positionParent, collision: "fit"});
//    $("#dialogRankAll" + title.replace(re, "")).css("display", "");
//    $("#dialogRankAll" + title.replace(re, "")).dialog();
  },
  resetDialog : function(title) {
    var re = /\s/gi;
    var objTable = $("#dataTblRank" + title.replace(re, "")).DataTable();
    objTable.order([[0,"asc"]]).draw();
  }
};