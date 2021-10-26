<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class TemplateContact extends Controller
{

  use Partials\PageHeader;
  
  var $acf_fields;

  public function __construct() {
    $this->acf_fields = (object) get_fields();
  }

  public function form() {
    return (object) array(
      'title' => $this->acf_fields->form_title,
      'intro' => ($this->acf_fields->form_intro) ? $this->acf_fields->form_intro : false,
      'contact_form'  => $this->acf_fields->form,
      'content'  => $this->acf_fields->content
    );
  }

  public function contact_info() {
    $output = array(
      'text' => $this->acf_fields->contact_info_text,
      'info' => $this->acf_fields->contact_info,
      'addresses' => $this->acf_fields->contact_info_addresses,
    );

    return (object) $output;
  } 

  public function distributors() {
    return $this->acf_fields->distributors;
  }
}
