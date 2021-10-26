<?php

namespace App\Controllers;

use Sober\Controller\Controller;
use WP_Query;

class TemplateCaseStudies extends Controller
{
  use Partials\PageHeader;
  use Partials\FlexibleContent;
  
  var $acf_fields;

  public function __construct() {
    $this->acf_fields = (object) get_fields();
  }

  public function filter_products() {

    $output = array();

    $query_products = new WP_Query(
      array(
        'post_type'       => 'product',
        'post_status'     => 'publish',
        'posts_per_page'  => -1,
        'orderby'         => 'post_title',
        'order'           => 'ASC'
      )
    );

    if ( !empty($query_products->posts) ) {
      foreach ( $query_products->posts as $product ) {
        $output[$product->ID] = $product->post_title;
      }
    }

    return $output;
  }

  public function filter_applications() {

    $applications = $terms = get_terms( 'application', array(
      'hide_empty' => true,
    ) );
  
    return $applications;
  }

  public function filter_locations() {

    $output = array();
    
    $all_locations = json_decode(get_option('case_studies_locations'));
    
    if( $all_locations!==NULL && !empty($all_locations) ) {
      return $all_locations;
    }else {
      return false;
    }

  }

  public function case_studies() {


    $url = parse_url($_SERVER['REQUEST_URI']);
    $url_query_string = parse_str($url['query'], $query_strings);
    
    $output = array();
    $location_id = $query_strings['location'];
    $product_id = $query_strings['product-id'];
    $application_id = $query_strings['application'];

    $meta_query = array();
    $output = array();

    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

    $query_posts_args = array(
        'post_type'       => 'case-study',
        'post_status'     => 'publish',
        'posts_per_page'  => 12,
        'orderby'         => 'post_date',
        'order'           => 'DESC',
        'paged'           => $paged
    );

    if ( !empty($location_id) ) {
      $all_locations = (array) json_decode(get_option('case_studies_locations'));
      $searched_location = array_key_exists($location_id, $all_locations) ? $all_locations[$location_id] : NULL;

      if ($searched_location!==NULL) {
        array_push($meta_query, array(
            'key'     => 'project_location',
            'value'   => $searched_location,
            'compare' => 'LIKE'
          )
        );
      }
    }

    if ( !empty($product_id) ) {
      array_push($meta_query, array(
          'key'     => 'products',
          'value'   => $product_id,
          'compare' => 'LIKE'
        )
      );
    }

    if ( !empty($application_id) ) {
      array_push($meta_query, array(
            'taxonomy' => 'application',
            'field'    => 'term_id',
            'terms'    => $application_id,
            'operator' => 'IN'
        )
      );      
    }

    if ( count($meta_query)>1 ) {
      $meta_query_args = array(
        'relation' => 'AND',
        $meta_query
      );
    }else {
      $meta_query_args = array($meta_query);
    }

    $query_posts_args['meta_query'] = $meta_query_args;

    $query_posts = new WP_Query($query_posts_args);

    return $query_posts;
  }
}
