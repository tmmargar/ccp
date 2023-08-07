<?php
declare(strict_types = 1);
namespace ccp;
use ccp\classes\model\SmartyLocalService;
  $smartyCcp = new SmartyLocalService();
  $smartyCcp->initialize(false);
  // variable used in individual pages
  $smarty = $smartyCcp->getSmarty();