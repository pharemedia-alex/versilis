<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class Page extends Controller
{
  use Partials\FlexibleContent;
  use Partials\PageHeader;
  
  var $acf_fields;

  public function __construct() {
    $this->acf_fields = (object) get_fields();
  }
}
