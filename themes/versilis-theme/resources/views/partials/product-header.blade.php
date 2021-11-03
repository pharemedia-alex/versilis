@if($product_header->background->type=="image" && !empty($product_header->background->responsive_image['format_desktop']))
  <div class="product-header {!! $product_header->background->color !!} -img-bg">
    <div class="product-header__bg-img">
      @if ( !empty($product_header->background->responsive_image['format_mobile']) )
      {{-- custom src set to display different images on mobile or desktop --}}
        <picture>
          <source media="(max-width: 767px)" srcset="{!! wp_get_attachment_image_url( $product_header->background->responsive_image['format_mobile'], array('768','1013') ) !!}">
          <source media="(min-width: 768px)" srcset="{!! wp_get_attachment_image_url( $product_header->background->responsive_image['format_desktop'], 'full' ) !!} 1920w,
                                                      {!! wp_get_attachment_image_url( $product_header->background->responsive_image['format_desktop'], array('1250','613') ) !!} 1250w">
          <img src="{!! wp_get_attachment_image_url( $product_header->background->responsive_image['format_desktop'], 'full' ) !!}" alt="{!! get_post_meta($page_header->background->responsive_image['format_desktop'], '_wp_attachment_image_alt', TRUE); !!}">
        </picture>
      @elseif ( !empty($product_header->background->responsive_image['format_desktop']) )
        {!! wp_get_attachment_image( $product_header->background->responsive_image['format_desktop'], 'full' ) !!}
      @endif
    </div>
@else
  <div class="product-header">
@endif
    <div class="product-header__content {!! $product_header->content->alignment !!}">
      <div class="o-container">
        <div class="row">
          <div class="{!! ( $product_header->content->alignment!=='content-left' ) ? 'col-12 col-lg-12 col-xl-10' : 'col-12 col-md-6 col-lg-5 col-xl-4' !!} header-text -t-animate">
            @if ( !empty($product_header->type) )
              <h4 class="label u-pb">{!! $product_header->type->name !!}</h4>
            @endif
            <h1>
              {!! !empty($product_header->content->title) ? $product_header->content->title : get_the_title() !!}
            </h1>
            {{-- Add exception for specific content such as blog posts, job offers, etc or add an option to use default title --}}
            @if( !empty($product_header->content->text) )
              <div class="product-header__subtitle">{!! $product_header->content->text !!}</div>
            @endif
          </div>
        </div>

      </div>
    </div>

</div>
