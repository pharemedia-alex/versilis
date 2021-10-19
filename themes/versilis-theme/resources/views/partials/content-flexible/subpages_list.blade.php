@php

$subpages = '';

//get all sibling pages except the current one
  if ( is_page() && $post->post_parent ) {
    $subpages = (object) get_pages(
      array(
        'child_of'    => $post->post_parent,
        //'exclude'     => $post->ID,
        'sort_column' => 'menu_order'
      )
    );
  }elseif( is_page() && $post->post_parent==0 ) {
    $subpages = (object) get_pages(
      array(
        'child_of'    => $post->ID,
        //'exclude'     => $post->ID,
        'sort_column' => 'menu_order'
      )
    );
  }

  $parent_page_header = get_field('header_content', $post->post_parent);
  $parent_title = ( !empty($parent_page_header['title']) ) ? $parent_page_header['title'] : get_the_title($post->post_parent);

@endphp

@if ( !empty($subpages) )
  <section class="cf-subpages-list">
    <div class="o-container --pt-lg --pb-lg">
      <div class="row -t-animate justify-content-between align-items-center">
        <div class="col-12 col-md-7">
          <h3 class="h2">{!! $parent_title !!}</h3>
        </div>
        <div class="col-12 col-md-5">
          @foreach ($subpages as $page)
            <div class="page-link">
              <a href="{!! get_permalink($page->ID) !!}" title="{!! $page->post_title !!}" class="h3">{!! $page->post_title !!}</a>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>
@endif