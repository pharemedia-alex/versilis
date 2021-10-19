{{--
  Template Name: First child redirect
--}}

@php

if (have_posts()) {
  while (have_posts()) {
    the_post();
    $childpage = get_pages("child_of=".$post->ID."&sort_column=menu_order");
    $firstchild = $childpage[0];
    wp_redirect(get_permalink($firstchild->ID));
  }
}

@endphp