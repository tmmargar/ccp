<!doctype html>
<html>
<head>
 <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- no head because joomla module adds empty whitespace to top -->
 <title>{$title}</title>
 <style type="text/css">
  @import url("css/jquery-ui.css");
  @import url("css/menu.css");
  @import url("css/display.css");
  @import url("css/datatables.css");
 </style>
 {$style}
 <script src="scripts/jquery/jquery.js" type="text/javascript"></script>
 <script src="scripts/jquery/jquery-ui.js" type="text/javascript"></script>
 <script src="scripts/jquery/jquery.dataTables.min.js" type="text/javascript"></script>
 <script src="scripts/jquery/jquery-ui-timepicker-addon.js" type="text/javascript"></script>
 <script src="scripts/jquery/jquery-migrate-3.0.0.js"></script>
 <script src="scripts/scripts.js" type="text/javascript"></script>
 {$script}
</head>
<body>
 <form action="{$action}" method="post" id="{$formName}" name="{$formName}">
  <fieldset>
  {$content}
  </fieldset>
 </form>
</body>
</html>