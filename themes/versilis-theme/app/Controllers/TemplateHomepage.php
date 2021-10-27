<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class TemplateHomepage extends Controller
{
  
  var $acf_fields;
  use Partials\CaseStudiesModule;

  public function __construct() {
    $this->acf_fields = (object) get_fields();
  }

  public function page_header(){
    $header_content = array(
        'alignment' => $this->acf_fields->header_content_alignment,
        'background' => (object) $this->acf_fields->header_background,
        'content' => (object) $this->acf_fields->header_content,
    );

    return (object) $header_content;
  }

  public function map() {
    $output = array(
      'title' => $this->acf_fields->map_title,
      'map_info_1' => $this->acf_fields->map_info_1,
      'map_info_2' => $this->acf_fields->map_info_2,
      'map_info_3' => $this->acf_fields->map_info_3
    );

    return $output;
  }

  public function highlight() {
    $output = array(
      'title' => $this->acf_fields->highlight_title,
      'text' => $this->acf_fields->highlight_text,
      'link' => $this->acf_fields->highlight_link
    );

    return $output;
  }

  public function innovation() {
    $output = array(
      'title' => $this->acf_fields->innovation_title,
      'text' => $this->acf_fields->innovation_text,
      'link' => $this->acf_fields->innovation_link,
      'elements' => $this->acf_fields->innovation_elements,
    );

    return $output;
  }

  public function call_to_action() {
    return (object) $this->acf_fields->call_to_action;
  }
}
