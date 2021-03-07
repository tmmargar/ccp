<?php
namespace ccp;
require_once "init.php";
$smarty->assign("title", "Chip Chair and a Prayer Change Log");
$smarty->assign("style", "");
$outputChange =
  "<h1>Change Log</h1>\n" .
  "<section class=\"version\" id=\"1.2.0\">" .
  " <h3>Version 1.2.0</h3>\n" .
  " <b><time datetime=\"TBD\">TBD</time></b>\n" .
  " <ul>\n" .
  "  <li>Future changes" .
  "   <ul>\n" .
  "    <li>Upgrade JavaScript to ES 6 (IE no longer supported)</li>\n" .
  "    <li>Upgrade PHP to 8.x</li>\n" .
  "    <li>Replace JQuery UI dialog and date time picker</li>\n" .
  "    <li>Replace JQuery UI with ?</li>\n" .
  "    <li>Add support for non CCP events</li>\n" .
  "    <li>Add ability to auto approve user</li>\n" .
  "    <li>Add remember me</li>\n" .
  "   </ul>\n" .
  "  </li>\n" .
  " </ul>\n" .
  "</section>\n" .
  "<h1>Change Log</h1>\n" .
  "<section class=\"version\" id=\"1.1.0\">" .
  " <h3>Version 1.1.0</h3>\n" .
  " <b><time datetime=\"2021-01-26\">Jan 26, 2021</time></b>\n" .
  " <ul>\n" .
  "  <li>Key tools and versions" .
  "   <ul>\n" .
  "    <li>(Database) MariaDB 10.4.17</li>\n" .
  "    <li>(Language) PHP 7.4</li>\n" .
  "    <li>(Email Library) PHP Mailer 6.2</li>\n" .
  "    <li>(Templating) Smarty 3.1.38</li>\n" .
  "    <li>(JavaScript framework) JQuery 3.5.1</li>\n" .
  "    <li>(JavaScript framework) JQuery UI 1.12.1</li>\n" .
  "    <li>(JavaScript framework) Datatables 1.10.23</li>\n" .
  "   </ul>\n" .
  "  </li>\n" .
  "  <li>Administrators ONLY\n" .
  "   <ul>\n" .
  "    <li>Added payouts</li>\n" .
  "    <li>Added seasons</li>\n" .
  "    <li>Added special types (for tournaments)</li>\n" .
  "   </ul>\n" .
  "  </li>\n" .
  "  <li>Changed menu and moved to left</li>\n" .
  "  <li>Updated all user ids to be sequential</li>\n" .
  "  <li>Added foreign keys to appropriate tables</li>\n" .
  "  <li>Added notification header for system messages</li>\n" .
  " </ul>\n" .
  "</section>\n" .
  "<section class=\"version\" id=\"1.0.0\">" .
  " <h3>Version 1.0.0</h3>\n" .
  " <b><time datetime=\"2020-06-07\">June 7, 2020</time></b>\n" .
  " <ul>\n" .
  "  <li>Added championship statistics</li>\n" .
  "  <li>Added security to only allow administrators access to certain pages</li>\n" .
  "  <li>Added my profile to allow editing of their own user information</li>\n" .
  "  <li>Force HTTPS for all requests</li>\n" .
  "  <li>Administrators ONLY\n" .
  "   <ul>\n" .
  "    <li>Added manage users</li>\n" .
  "    <li>Added send email</li>\n" .
  "    <li>Added run auto register host</li>\n" .
  "    <li>Added run auto reminder</li>\n" .
  "   </ul>\n" .
  "  </li>\n" .
  " </ul>\n" .
  "</section>\n";
$smarty->assign("content", $outputChange);
$smarty->display("changeLog.tpl");