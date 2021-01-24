<?php
namespace ccp;
use ccp\classes\utility\SessionUtility;
require_once "init.php";
echo SessionUtility::destroy();
header("Location:login.php?" . $_SERVER["QUERY_STRING"]);