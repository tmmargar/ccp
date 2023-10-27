<?php
declare(strict_types = 1);
namespace ccp;
use ccp\classes\model\SmartyLocal;
  $smartyCcp = new SmartyLocal();
  $smartyCcp->initialize(debug: false);
  // variable used in individual pages
  $smarty = $smartyCcp->getSmarty();