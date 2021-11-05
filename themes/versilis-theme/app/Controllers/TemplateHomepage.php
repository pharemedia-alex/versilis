<?php

namespace App\Controllers;

use Sober\Controller\Controller;
use WP_Query;

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

  public function product_types(){
    $output = array();

    $product_types = $this->acf_fields->product_types;
    
    foreach ( $product_types as $type ) {
      $args = array(
        'post_type' => 'product',
        'tax_query' => array(
            array(
            'taxonomy' => 'product-type',
            'field' => 'term_id',
            'terms' => $type->term_id
             )
          )
        );

      $products = new WP_Query( $args );

      $tax_products = array();
      if ( !empty($products->posts) ) {
        foreach( $products->posts as $product ) {
          array_push( $tax_products, array(
            'id'    => $product->ID,
            'name'  => $product->post_title,
            'link'  => get_permalink($product->ID),
            'label' => get_field('crashworthy', $product->ID)
            )
          );
        }

        array_push( $output,
          array(
            'cover' => get_field('cover_image', 'term_' . $type->term_id),
            'title' => $type->name,
            'description' => $type->description,
            'products' => $tax_products,
          )
        );
      }
    }  

    return $output;
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
