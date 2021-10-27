@if($page_header->background->type=="image" && !empty($page_header->background->responsive_image['format_desktop']))
  <div class="home-header">
    <div class="o-container">
      <div class="row">
        <div class="col-12">
          <div class="home-header__content">
            <div class="row">
              <div class="col-11 col-md-6 col-lg-4">
        
                <h1>
                  {!! !empty($page_header->content->title) ? $page_header->content->title : get_the_title() !!}
                </h1>

                {{-- Add exception for specific content such as blog posts, job offers, etc or add an option to use default title --}}
                @if( !empty($page_header->content->text) )
                  <div class="home-header__subtitle">{!! $page_header->content->text !!}</div>
                @endif

                @if( !empty($page_header->content->link) )
                  <a href="{!! $page_header->content->link['url'] !!}"
                    class="btn home-header__link u-mt-sm"
                    title="{!! $page_header->content->link['title'] !!}"
                    target="{!! $page_header->content->link['target'] !!}">
                  {!! $page_header->content->link['title'] !!}
                  </a>
                @endif

              </div>

            </div>
          </div>
        </div>
      </div>
      <div class="home-header__right">
        <div class="home-header__img-wrapper">
          @if($page_header->background->type=="image" && !empty($page_header->background->responsive_image['format_desktop']))
            @if ( !empty($page_header->background->responsive_image['format_mobile']) )
            {{-- custom src set to display different images on mobile or desktop --}}
              <picture>
                <source media="(max-width: 767px)" srcset="{!! wp_get_attachment_image_url( $page_header->background->responsive_image['format_mobile'], array('768','1013') ) !!}">
                <source media="(min-width: 768px)" srcset="{!! wp_get_attachment_image_url( $page_header->background->responsive_image['format_desktop'], 'full' ) !!} 1920w,
                                                            {!! wp_get_attachment_image_url( $page_header->background->responsive_image['format_desktop'], array('1250','613') ) !!} 1250w">
                <img src="{!! wp_get_attachment_image_url( $page_header->background->responsive_image['format_desktop'], 'full' ) !!}" alt="{!! get_post_meta($page_header->background->responsive_image['format_desktop'], '_wp_attachment_image_alt', TRUE); !!}">
              </picture>
            @elseif ( !empty($page_header->background->responsive_image['format_desktop']) )
              {!! wp_get_attachment_image( $page_header->background->responsive_image['format_desktop'], 'full' ) !!}
            @endif
          @endif
        </div>
      </div>

    </div>
  </div>
@endif