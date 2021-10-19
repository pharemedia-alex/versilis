<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class TemplateStandard extends Controller
{
  use Partials\PageHeader;
  use Partials\FlexibleContent;
  
  var $acf_fields;

  public function __construct() {
    $this->acf_fields = (object) get_fields();
  }
}
