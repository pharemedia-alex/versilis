
<section {!! (!empty($content_block->section_id)) ? 'id="'.$content_block->section_id.'"' : '' !!} class="cf-text-images">
  <div class="text-images">

    @foreach($content_block->elements as $element)
      @php $element = (object) $element; @endphp
    
      <div class="text-images__element -t-animate">
        
        @if ( $element->image['image_file']!==false )
          <div class="text-images__image order-last {!! ($element->image['image_alignment']=='right') ? 'order-lg-last' : 'order-lg-first' !!}">
            <div class="o-wrapper --pb-xl">
              {!! wp_get_attachment_image( $element->image['image_file'], 'layout_img' ) !!}
            </div>
          </div>
          @endif
          
          <div class="text-images__text {!! ($element->image['image_alignment']=='right') ? 'right-alignment' : 'left-alignment' !!}">
            <div class="o-wrapper --pb-xl">
              <h2 class="text-images__title">{!! $element->title !!}</h2>
              <div class="o-content">{!! $element->text !!}</div>
              
              @if( $element->add_button===true )
                @php 
                  $button_params = array(
                    'button_classes' => 'cf-highlight__btn --color-green-grey', 
                    'button_content' => (object) $element->button
                  );
                @endphp
                @include('partials.content-flexible.button', $button_params)
              @endif
            </div>
          </div>

      </div>
      <div class="divider">
        <div></div>
      </div>

    @endforeach

  </div>
</section>
