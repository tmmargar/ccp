<!doctype html>
<html>
<head>
 <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>{$title}</title>
 <style type="text/css">
  @import url("css/jquery-ui.css");
  @import url("css/menu.css");
  @import url("css/datatables.css");
  @import url("css/display.css");
 </style>
 {$style}
 <script src="scripts/jquery/jquery.js" type="text/javascript"></script>
 <script src="scripts/jquery/jquery-ui.js" type="text/javascript"></script>
 <script src="scripts/jquery/datatables.js" type="text/javascript"></script>
 <script src="scripts/jquery/jquery-migrate-3.0.0.js"></script>
 <script src="scripts/scripts.js" type="text/javascript"></script>
 {$script}
</head>
<body>
 {$navigation}
 <div id="content">
  <h1>{$title}</h1>
  <div id="infoPersist" style="display:none">
   <span id="errorsPersist" style="display: none"></span>
   <br />
  </div>
  <div id="info" style="display:none">
   <span id="errors" style="display: none"></span>
   <br />
   <span id="messages" style="display: none"></span>
  </div>
  <form action="{$action}" method="POST" id="{$formName}" name="{$formName}">
   {$content}
  </form>
 </div>
</body>
</html>