<!doctype html>
<html>
<head>
 <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>{block name=title}Default Title{/block}</title>
 <style type="text/css">
  @import url("css/jquery-ui.css");
  @import url("css/jquery.datetimepicker.css");
  @import url("css/datatables.css");
  @import url("css/display.css");
  @import url("css/sm-core-css.css");
  @import url("css/sm-blue.css");
 </style>
 {block name=style}{/block}
 <script src="scripts/jquery/jquery.js" type="text/javascript"></script>
 <script src="scripts/jquery/jquery-ui.js" type="text/javascript"></script>
 <script src="scripts/jquery/jquery-migrate-3.0.0.js"></script>
 <script src="scripts/jquery/datatables.js" type="text/javascript"></script>
 <script src="scripts/jquery/jquery.datetimepicker.full.min.js" type="text/javascript"></script>
 <script src="scripts/jquery/jquery.smartmenus.js" type="text/javascript"></script>
 <script src="scripts/scripts.js" type="text/javascript"></script>
 {block name=script}{/block}
</head>
<body>
 {block name=navigation}{$navigation}{/block}
 <div id="content">
  {block name=content}{$content}{/block}
 </div>
 {block name=footer}<footer class="footer"><a href="changeLog.php">Change Log</a></footer>{/block}
</body>
</html>