<?php

namespace App\Controllers\Partials;

trait PageHeader
{
    public function page_header(){
        $header_content = array(
            'alignment' => $this->acf_fields->header_content_alignment,
            'background' => (object) $this->acf_fields->header_background,
            'content' => (object) $this->acf_fields->header_content,
        );

        return (object) $header_content;
    }
}