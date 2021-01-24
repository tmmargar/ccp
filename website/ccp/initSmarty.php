<?php
namespace ccp;
use ccp\classes\model\SmartyLocal;
  $smartyCcp = new SmartyLocal();
  $smartyCcp->initialize();
  // variable used in individual pages
  $smarty = $smartyCcp->getSmarty();
