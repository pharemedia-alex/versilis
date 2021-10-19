<section {!! (!empty($content_block->section_id)) ? 'id="'.$content_block->section_id.'"' : '' !!} class="cf-team">
  <div class="o-container --pt-xl -t-animate">
    <div class="row">

    @foreach ($content_block->team_members as $member)

    <div class="col-12 col-sm-6 col-lg-4 col-xxl-3 member">
      <div class="o-wrapper --pb-xl">
        <div class="member__photo u-mb">
          {!! wp_get_attachment_image( $member['photo'], array('544', '744') ) !!}
        </div>
        <div class="member__info">
          <h3 class="member__name">{!! $member['name'] !!}</h3>
          <div class="member__position o-content match-height">{!! $member['position'] !!}</div>
        
          @if ( !empty($member['email']) )
            <div class="member__email u-pt o-content"><a href="mailto:{!! $member['email'] !!}" title="{!! __('Contact ', 'versilis-theme') . $member['name'] . __(' by email', 'versilis-theme'); !!}">{!! $member['email'] !!}</a></div>
          @endif
        
          @if ( !empty($member['bio']) )
            <div class="o-content member__bio u-pt o-content">{!! $member['bio'] !!}</div>
          @endif
        </div>
      </div>
    </div>
        
    @endforeach

    </div>

  </div>
</section>