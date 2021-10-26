<?php

namespace App\Controllers;

use Sober\Controller\Controller;
use WP_Query;

class SingleProduct extends Controller
{
  use Partials\PageHeader;
  use Partials\CaseStudiesModule;
  
  var $acf_fields;

  public function __construct() {
    $this->acf_fields = (object) get_fields();
    //var_dump($this->acf_fields);
  }

  public function document_links() {
    return $this->acf_fields->files;
  }

  public function overview(){
    return array(
      'title' => $this->acf_fields->overview_title,
      'content' => $this->acf_fields->overview_content
    );
  }

  public function applications() {
    $output = array();
    $output['title'] = $this->acf_fields->application_title;

    $output['elements'] = get_the_terms($post->ID, 'application');
    
    return $output;
  }

  public function faq() {
    return $this->acf_fields->faq_elements;
  }

  public function photos() {
    return $this->acf_fields->photos;
  }

  public function call_to_action() {
    return (object) $this->acf_fields->call_to_action;
  }

}
