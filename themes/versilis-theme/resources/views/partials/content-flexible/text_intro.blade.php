<section {!! (!empty($content_block->section_id)) ? 'id="'.$content_block->section_id.'"' : '' !!} class="cf-text-intro">
  <div class="o-container --pt-xl --pb-xl -t-animate">

    <div class="row">
      <div class="col-12">
        <div class="o-wrapper">
          <h3 class="cf-text-intro__title">{!! $content_block->title !!} {!! ( !empty($content_block->subtitle) ) ? '<span>' . $content_block->subtitle . '</span>' : '' !!}</h3>
          <div class="cf-text-intro__text o-content">{!! $content_block->text !!}</div>
        </div>
      </div>
    </div>

  </div>
</section>