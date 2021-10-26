<?php

namespace App\Controllers\Partials;
use WP_Query;

trait CaseStudiesModule
{
    public function case_studies(){
        $filter = '';
        $elements = array();

        $case_studies_page = get_field('case_studies_page', 'option');

        $output = array(
            'title'     => $this->acf_fields->title,
            'intro'     => $this->acf_fields->intro
        );
        
        $args = array(
            'post_type'       => 'case-study',
            'post_status'     => 'publish',
            'posts_per_page'  => $this->acf_fields->entries_num,
            'orderby'         => 'menu_order',
            'order'           => 'ASC',
        );

        if ($this->acf_fields->auto === true) {
            $args_filter = array();
            if ( $this->acf_fields->filter ) {
                switch( $this->acf_fields->filter ) {
                    case "product": 
                        $args['meta_query'] = array(
                            array(
                                'key'     => 'products',
                                'value'   => $this->acf_fields->product,
                                'compare' => 'LIKE'
                            ),
                        );
                        break;

                    case "application": 
                        $args['tax_query'] = array(
                            array(
                                'taxonomy' => 'application',
                                'field'    => 'term_id',
                                'terms'    => $this->acf_fields->application,
                                'operator' => 'IN'
                            ),
                        );                
                        break;

                    default: 
                        break;
                }
            }
        }else {
            $args['post__in'] = $this->acf_fields->elements;
        }

        //remove current post ID

        $query_case_studies = new WP_Query($args);

        $output['query'] = $query_case_studies;
        $output['view_all'] = get_permalink($case_studies_page);

        return (object) $output;
        
    }
}