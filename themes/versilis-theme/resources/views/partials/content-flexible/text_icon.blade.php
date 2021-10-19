<section 
    {!! (!empty($content_block->section_id)) ? 'id="'.$content_block->section_id.'"' : '' !!} 
    class="cf-text-icon {!! (!empty($content_block->bg_color!=='none')) ? $content_block->bg_color : '' !!}">
  <div class="o-container --pt-xl --pb-xl -t-animate">
    <div class="row">
      <div class="col-12 col-lg-5">
        <div class="row">
          <div class="col-12 {!! ($content_block->icon_position=='right') ? 'col-lg-6' : '' !!}">
            <h2 class="cf-cta__title h2">{!! $content_block->main_title !!}</h2>
          </div>
          <div class="col-12 {!! ($content_block->icon_position=='right') ? 'col-lg-4' : 'align-self-end' !!} col-icon">
            <img src="{!! wp_get_attachment_url( $content_block->icon ) !!}" />
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-7">
        <div class="o-wrapper">
          @if ( !empty($content_block->text_title) )
            <h3 class="u-mb">{!! $content_block->text_title !!}</h3>
          @endif
          <div class="o-content">{!! $content_block->text !!}</div>

          @if( $content_block->add_button===true )
            @php
              $button_params = array(
                'button_classes' => '',
                'button_content' => (object) $content_block->button
              );
            @endphp
            <div class="cf-text-icon__button u-mt-md">
              @include('partials.content-flexible.button', $button_params)
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>
