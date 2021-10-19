<?php

namespace App\Controllers\Partials;

trait FlexibleContent
{
    public function flexible_content(){
        //flexible content
        return (object) $this->acf_fields->content_blocks;
    }
}