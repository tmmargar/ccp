<?php
namespace ccp\classes\model;
use Smarty;
class SmartyLocal {
  private $smarty;
  public function __construct() {
    $this->smarty = new Smarty();
  }
  public function getSmarty() {
    return $this->smarty;
  }
  public function initialize() {
    $this->smarty->setTemplateDir("templates/smarty");
    $this->smarty->setCompileDir("templates/smarty/compiled");
    $this->smarty->setCacheDir("classes/common/smarty/cache");
    $this->smarty->setConfigDir("classes/common/smarty/configs");
//     $this->smarty->registerClass("htmlUtility", "\ccp\classes\utility\HtmlUtility");
  }
  public function setSmarty($smarty) {
    $this->smarty = $smarty;
  }
}