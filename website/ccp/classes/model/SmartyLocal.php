<?php
declare(strict_types = 1);
namespace ccp\classes\model;
use Smarty;
class SmartyLocal {
  private Smarty $smarty;
  public function __construct() {
    $this->smarty = new Smarty();
//     $this->smarty->initialize();
  }
  public function getSmarty() {
    return $this->smarty;
  }
  public function initialize(bool $debug) {
    $this->smarty->setTemplateDir("templates/smarty");
    $this->smarty->setCompileDir("templates/smarty/compiled");
    $this->smarty->setCacheDir("classes/common/smarty/cache");
    $this->smarty->setConfigDir("classes/common/smarty/configs");
    $this->smarty->setDebugging($debug);
//     $this->smarty->registerClass("htmlUtility", "\ccp\classes\utility\HtmlUtility");
  }
  public function setSmarty(Smarty $smarty) {
    $this->smarty = $smarty;
  }
}