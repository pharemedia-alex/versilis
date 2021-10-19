<section 
  {!! (!empty($content_block->section_id)) ? 'id="'.$content_block->section_id.'"' : '' !!} 
  class="cf-text-2-cols {!! (!empty($content_block->bg_color)) ? $content_block->bg_color : '' !!}">
  <div class="o-container u-pt-md">

    <div class="row -t-animate">
      <div class="col-12 col-lg-6 u-pb-md">
        <div class="o-wrapper --pb-sm">
          <h2 class="cf-text-2-cols__title h3 u-pb">{!! $content_block->column_one['title'] !!}</h2>
          <div class="cf-text-2-cols__text o-content">{!! $content_block->column_one['content'] !!}</div>
        </div>
        
        @if( $content_block->column_one['add_button']===true )
          @php
            $button_params = array(
              'button_classes' => '--color-grey-green',
              'button_content' => (object) $content_block->column_one['button']
            );
          @endphp
          <div class="cf-text-2-cols__button">
            @include('partials.content-flexible.button', $button_params)
          </div>
        @endif
      </div>



      <div class="col-12 col-lg-6 u-pb-md">
        <div class="o-wrapper --pb-sm">
          <h2 class="cf-text-2-cols__title h3 u-pb">{!! $content_block->column_two['title'] !!}</h2>
          <div class="cf-text-2-cols__text o-content">{!! $content_block->column_two['content'] !!}</div>
        </div>

        @if( $content_block->column_two['add_button']===true )
          @php
            $button_params = array(
              'button_classes' => '--color-grey-green',
              'button_content' => (object) $content_block->column_two['button']
            );
          @endphp
          <div class="cf-text-2-cols__button">
            @include('partials.content-flexible.button', $button_params)
          </div>
        @endif

      </div>
    </div>

  </div>
</section>