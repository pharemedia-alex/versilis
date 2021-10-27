<?php

namespace App\Controllers;

use Sober\Controller\Controller;
use WP_Query;

class TemplateVideos extends Controller
{

  use Partials\PageHeader;
  
  var $acf_fields;

  public function __construct() {
    $this->acf_fields = (object) get_fields();
  }

  public function videos() {
    return $this->acf_fields->videos;
  }
}
