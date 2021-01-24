<?php
namespace ccp\classes\Test;
use ccp\classes\utility\FileUtility;
//include_once "../init.php";
//include_once ROOT . "/autoload.php";
echo FileUtility::getFileNames(getcwd(), array(".", "..", "BaseTest.class.php", "MainTest.class.php"));
?>