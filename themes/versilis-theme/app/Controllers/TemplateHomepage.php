<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class TemplateHomepage extends Controller
{

  use Partials\PageHeader;
  
  var $acf_fields;

  public function __construct() {
    $this->acf_fields = (object) get_fields();
  }

  public function content() {
    return $this->acf_fields->content;
  }
}
