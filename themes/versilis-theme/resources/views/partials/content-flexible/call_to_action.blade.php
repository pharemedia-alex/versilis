@php
  $button_params = array(
    'button_classes' => 'cf-cta__button',
    'button_content' => (object) $content_block->link
  );
@endphp

<section class="cf-cta">
  <div class="o-container --pt-xl --pb-xl -t-animate">
    <div class="cf-cta__content">
      <h3 class="cf-cta__title h2">{!! $content_block->title !!}</h3>
      <div class="cf-cta__text">{!! $content_block->text !!}</div>
      @include('partials.content-flexible.button', $button_params)
    </div>
  </div>
</section>
