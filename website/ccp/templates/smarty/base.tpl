<!doctype html>
<html lang="en">
<head>
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>{block name=title}{$title}{/block}</title>
 <link href="images/apple-touch-icon.png" rel="apple-touch-icon" sizes="180x180" type="image/png">
 <link href="images/favicon-32x32.png" rel="icon" sizes="32x32" type="image/png">
 <link href="images/favicon-16x16.png" rel="icon" sizes="16x16" type="image/png">
 <link href="images/site.webmanifest" rel="manifest">
 <link href="css/reset.css?v={$smarty.now|date_format:'%m/%d/%Y %H:%M:%S'}" rel="stylesheet">
 <link href="css/jquery-ui.css?v={$smarty.now|date_format:'%m/%d/%Y %H:%M:%S'}" rel="stylesheet">
 <link href="css/jquery.datetimepicker.css?v={$smarty.now|date_format:'%m/%d/%Y %H:%M:%S'}" rel="stylesheet">
 <link href="css/datatables.css?v={$smarty.now|date_format:'%m/%d/%Y %H:%M:%S'}" rel="stylesheet">
 <link href="css/menu.css?v={$smarty.now|date_format:'%m/%d/%Y %H:%M:%S'}" rel="stylesheet">
 <link href="css/display.css?v={$smarty.now|date_format:'%m/%d/%Y %H:%M:%S'}" rel="stylesheet">
 {block name=style}{/block}
 <script src="scripts/jquery/jquery.js?v={$smarty.now|date_format:'%m/%d/%Y %H:%M:%S'}"></script>
 <script src="scripts/jquery/jquery-ui.js?v={$smarty.now|date_format:'%m/%d/%Y %H:%M:%S'}"></script>
 <script src="scripts/jquery/jquery-migrate.js?v={$smarty.now|date_format:'%m/%d/%Y %H:%M:%S'}"></script>
 <script src="scripts/jquery/datatables.js?v={$smarty.now|date_format:'%m/%d/%Y %H:%M:%S'}"></script>
 <script src="scripts/jquery/jquery.datetimepicker.full.js?v={$smarty.now|date_format:'%m/%d/%Y %H:%M:%S'}"></script>
 <script src="scripts/jquery/jquery.mask.js?v={$smarty.now|date_format:'%m/%d/%Y %H:%M:%S'}"></script>
 <script src="scripts/scripts.js?v={$smarty.now|date_format:'%m/%d/%Y %H:%M:%S'}"></script>
 <script src="scripts/jqueryLocal.js?v={$smarty.now|date_format:'%m/%d/%Y %H:%M:%S'}"></script>
 <script src="scripts/dataTablesLocal.js?v={$smarty.now|date_format:'%m/%d/%Y %H:%M:%S'}"></script>
 <script src="scripts/urlSearchParams.js?v={$smarty.now|date_format:'%m/%d/%Y %H:%M:%S'}"></script>
 <script src="https://kit.fontawesome.com/c9cf137722.js?v={$smarty.now|date_format:'%m/%d/%Y %H:%M:%S'}" crossorigin="anonymous"></script>
 {block name=script}{/block}
</head>
<body>
{block name=navigation}{$navigation}{/block}
 <header id="header">
  {block name=header}{$header}{/block}
 </header>
 <div id="content">
  <h1>{$heading}</h1>
  <div id="modeDisplay">Mode: {$mode}</div>
  <div class="hide" id="info">
   <div class="hide" id="errors"></div>
   <div class="hide" id="messages"></div>
  </div>
  {block name=content}{$content}{/block}
 </div>
 {block name=footer}<footer class="footer"><a href="changeLog.php" target="_new">Change Log</a></footer>{/block}
</body>
</html>