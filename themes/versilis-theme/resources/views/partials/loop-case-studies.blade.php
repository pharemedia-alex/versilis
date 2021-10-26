@if ( $case_studies->have_posts() )
  <div class="row">
    @while( $case_studies->have_posts() ) 
      @php 
        $case_studies->the_post();
        $project_title = get_the_title();
        $project_location = get_field('project_location');
      @endphp
      <div class="col-12 col-md-6 col-lg-4 case-study" dataid="{{ get_the_id() }}">
        <div class="tile u-mt-sm">
          <a href="{!! get_permalink() !!}" title="{!! $project_title . ' - ' . $project_location !!}">
            <div class="tile__header">
              <div class="tile__header-image">
                @if ( has_post_thumbnail( ) )
                  {!! get_the_post_thumbnail( ) !!}
                @else
                  {{-- prevoir placeholder --}}
                @endif
              </div>
            </div>
            <div class="tile__content">
              <h3>{!! $project_title !!}</h3>
              <div class="project-location">
                @icon('location','icon')
                <span>{!! $project_location !!}</span>
              </div>
            </div>
          </a>
        </div>
      </div>
    @endwhile
    
  </div>

  <div class="pagination u-mt-md">
    {!! custom_pagination( $case_studies->max_num_pages, max( 1, get_query_var( 'paged' ) ), $url ) !!}
  </div>
  
  @else
    <div class="row">
      <div class="col-12 u-mt-md">
        {{ __('No case study available yet.', 'versilis-theme') }}           
      </div>
    </div>
  @endif

  @php wp_reset_postdata(); @endphp