<?php

namespace App\Controllers;

use Sober\Controller\Controller;
use WP_Query;

class Ajax extends Controller
{
  public static function filterCaseStudies() {
    $location_id = $_POST['location'];
    $product_id = $_POST['product'];
    $application_id = $_POST['application'];
    $base_url = $_POST['pageURL'];
        
    $meta_query = array();
    $output = array();
    $page = $_POST['page'];

    $query_posts_args = array(
      'post_type'       => 'case-study',
      'post_status'     => 'publish',
      'posts_per_page'  => 12,
      'orderby'         => 'post_date',
      'order'           => 'DESC',
      'paged'           => ($page>0) ? $page : 0,
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

    $query_posts['case_studies'] = new WP_Query($query_posts_args);
    $query_posts['url'] = $base_url;
    
    echo \App\Template('partials.loop-case-studies', $query_posts);

    wp_die();
  }
};