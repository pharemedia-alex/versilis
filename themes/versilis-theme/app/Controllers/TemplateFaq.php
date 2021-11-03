<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class TemplateFaq extends Controller
{

  use Partials\PageHeader;
  use Partials\FlexibleContent;
  
  var $acf_fields;

  public function __construct() {
    $this->acf_fields = (object) get_fields();
  }

  public function faq() {
    return $this->acf_fields->questions;
  }
}
