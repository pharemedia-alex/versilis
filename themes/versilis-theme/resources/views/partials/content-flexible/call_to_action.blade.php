@php
  $button_params = array(
    'button_classes' => 'cf-cta__button',
    'button_content' => (object) $content_block->cta_link
  );
@endphp

<section class="cf-cta">
  <div class="o-container --pt-xl --pb-xl">
    <div class="cf-cta__content -t-animate">
      <h3 class="cf-cta__title h2">{!! $content_block->cta_title !!}</h3>
      <div class="cf-cta__text">{!! $content_block->cta_text !!}</div>
      @include('partials.content-flexible.button', $button_params)
    </div>
  </div>
</section>
