<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class SingleCaseStudy extends Controller
{
  use Partials\PageHeader;
  use Partials\CaseStudiesModule;
  
  var $acf_fields;

  public function __construct() {
    $this->post_id = get_the_id();
    $this->acf_fields = (object) get_fields();
  }

  public function properties() {
    $applications = get_the_terms( $post->ID, 'application' );

    return (object) array(
      'location' => $this->acf_fields->project_location,
      'status' => $this->acf_fields->project_status,
      'application' => $applications[0]->name
    );
  }

  public function overview() {
    return $this->acf_fields->overview_content;
  }

  public function scope() {
    $output = array(
      'main_title'    => $this->acf_fields->scope_main_title,
      'text_left'    => $this->acf_fields->scope_text_left,
      'text_right'    => $this->acf_fields->scope_text_right,
      'img_left'    => $this->acf_fields->scope_img_left,
      'img_right'    => $this->acf_fields->scope_img_right,
    );

    return (object) $output;
  }

  public function benefits() {
    $output = array(
      'main_title'  => $this->acf_fields->benefits_main_title,
      'boxes'       => $this->acf_fields->benefits_boxes,
    );

    return (object) $output;
  }

  public function photos() {
    return $this->acf_fields->photos;
  }

  public function video() {
    return (object) $this->acf_fields->video;
  }

  public function quote() {
    $output = array(
      'content'    => $this->acf_fields->quote_content,
      'person'    => $this->acf_fields->quote_person,
      'title'    => $this->acf_fields->quote_person_title,
      'company'    => $this->acf_fields->quote_company,
    );

    return (object) $output;
  }

  public function call_to_action() {
    return (object) $this->acf_fields->call_to_action;
  }
}
