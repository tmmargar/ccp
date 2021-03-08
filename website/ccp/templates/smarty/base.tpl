<!doctype html>
<html>
<head>
 <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>{block name=title}Default Title{/block}</title>
 <link href="images/apple-touch-icon.png" rel="apple-touch-icon" sizes="180x180">
 <link href="images/favicon-32x32.png" rel="icon" type="image/png" sizes="32x32">
 <link href="images/favicon-16x16.png" rel="icon" type="image/png" sizes="16x16">
 <link href="images/site.webmanifest" rel="manifest">
 <link href="css/jquery-ui.css" rel="stylesheet" type="text/css">
 <link href="css/jquery.datetimepicker.css" rel="stylesheet" type="text/css">
 <link href="css/datatables.css" rel="stylesheet" type="text/css">
 <link href="css/display.css" rel="stylesheet" type="text/css">
 <link href="css/sm-core-css.css" rel="stylesheet" type="text/css">
 <link href="css/sm-blue.css" rel="stylesheet" type="text/css">
 {block name=style}{/block}
 <script src="scripts/jquery/jquery.js" type="text/javascript"></script>
 <script src="scripts/jquery/jquery-ui.js" type="text/javascript"></script>
 <script src="scripts/jquery/jquery-migrate.js"></script>
 <script src="scripts/jquery/datatables.js" type="text/javascript"></script>
 <script src="scripts/jquery/jquery.datetimepicker.full.js" type="text/javascript"></script>
 <script src="scripts/jquery/jquery.smartmenus.js" type="text/javascript"></script>
 <script src="scripts/scripts.js" type="text/javascript"></script>
 <script src="scripts/jqueryLocal.js" type="text/javascript"></script>
 <script src="scripts/dataTablesLocal.js" type="text/javascript"></script>
 <script src="scripts/urlSearchParams.js" type="text/javascript"></script>
 {block name=script}{/block}
</head>
<body>
 {block name=navigation}{$navigation}{/block}
 <div id="contentTop">
  {block name=contentTop}{$contentTop}{/block}
 </div>
 <div id="content">
  <h1>{$heading}</h1>
  <div class="hide" id="info">
   <div class="hide" id="errors"></div>
   <div class="hide" id="messages"></div>
  </div>
  {block name=content}{$content}{/block}
 </div>
 {block name=footer}<footer class="footer"><a href="changeLog.php">Change Log</a></footer>{/block}
</body>
</html>