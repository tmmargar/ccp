<?php
declare(strict_types = 1);
namespace ccp;
require_once "init.php";
$smarty->assign("title", "Chip Chair and a Prayer Change Log");
$smarty->assign("heading", "");
$smarty->assign("style", "");
$outputChange =
  "<h1>Change Log</h1>\n" .
  "<section class=\"version\" id=\"1.2.1\">" .
  " <h3>Version 1.2.1</h3>\n" .
  " <b><time datetime=\"2023-10-04\">Oct 4, 2023</time></b>\n" .
  " <ul>\n" .
  "  <li>Upgrade Smarty to 4.3.2</li>\n" .
  "  <li>Upgrade PHP to 8.1.24</li>\n" .
  "  <li>Fix errors caused by PHP upgrade or hidden errors</li>\n" .
  " </ul>\n" .
  "</section>\n" .
  "<section class=\"version\" id=\"1.2.0\">" .
  " <h3>Version 1.2.0</h3>\n" .
  " <b><time datetime=\"2023-03-01\">Mar 1, 2023</time></b>\n" .
  " <ul>\n" .
  "  <li>Change javascript to ES modules</li>\n" .
  "  <li>Change selectize to tom select for email\n" .
  "  <li>Change mask to non jquery version\n" .
  "  <li>Change datetimepicker to HTML5\n" .
  "  <li>Remove jquery ui\n" .
  "  <li>Change jquery and datatables to use CDN</li>\n" .
  " </ul>\n" .
  "</section>\n" .
  "<section class=\"version\" id=\"1.1.2\">" .
  " <h3>Version 1.1.2</h3>\n" .
  " <b><time datetime=\"2023-01-17\">Jan 17, 2023</time></b>\n" .
  " <ul>\n" .
  "  <li>Updated datatables, jQuery, jQuery UI and jQuery Migrate to latest versions</li>\n" .
  " </ul>\n" .
  "</section>\n" .
  "<section class=\"version\" id=\"1.1.1\">" .
  " <h3>Version 1.1.1</h3>\n" .
  " <b><time datetime=\"2023-01-13\">Jan 13, 2023</time></b>\n" .
  " <ul>\n" .
  "  <li>Updated to be mobile friendly</li>\n" .
  "  <li>Fixed some minor bugs on maintenance screens</li>\n" .
  " </ul>\n" .
  "</section>\n" .
  "<section class=\"version\" id=\"1.1.0\">" .
  " <h3>Version 1.1.0</h3>\n" .
  " <b><time datetime=\"2021-05-22\">May 22, 2021</time></b>\n" .
  " <ul>\n" .
  "  <li>Key tools and versions" .
  "   <ul>\n" .
  "    <li>(Database) MariaDB 10.4.17</li>\n" .
  "    <li>(Language) PHP 8.0</li>\n" .
  "    <li>(Email Library) PHP Mailer 6.2</li>\n" .
  "    <li>(Templating) Smarty 3.1.38</li>\n" .
  "    <li>(JavaScript framework) JQuery 3.5.1</li>\n" .
  "    <li>(JavaScript framework) JQuery UI 1.12.1</li>\n" .
  "    <li>(JavaScript framework) Datatables 1.10.23</li>\n" .
  "   </ul>\n" .
  "  </li>\n" .
  "  <li>Administrators ONLY\n" .
  "   <ul>\n" .
  "    <li>Added notifications</li>\n" .
  "    <li>Added payouts</li>\n" .
  "    <li>Added seasons</li>\n" .
  "    <li>Added special types (for tournaments)</li>\n" .
  "    <li>Added site down capability</li>\n" .
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