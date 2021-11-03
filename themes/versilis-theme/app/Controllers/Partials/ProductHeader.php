<?php

namespace App\Controllers\Partials;

trait ProductHeader
{
    public function product_header(){
        $product_type = get_the_terms( $post->ID , 'product-type' );

        $header_content = array(
            'background' => (object) $this->acf_fields->header_background,
            'content' => (object) $this->acf_fields->header_content,
            'type' => $product_type[0]
        );

        return (object) $header_content;
    }
}