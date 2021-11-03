
@if ( $case_studies->query->have_posts() )

  <section class="case-studies-list">

    <div class="case-studies__content-wrapper -t-animate">
      <div class="o-container --pt-xl --pb-xl">
        <div class="row -t-animate">
          <div class="col-12 col-lg-6">        
            <h2 class="u-mb">{!! $case_studies->title !!}</h2>
          </div>
        </div>
        <div class="row align-items-end -t-animate">
          <div class="col">
            <a href="{!! $case_studies->view_all !!}"
              title="{!! __('View all case studies', 'versilis-theme') !!}"
              class="btn --primary">
              {!! __('View all', 'versilis-theme') !!}
            </a>
          </div>
          <div class="col">
            <div class="case-studies-list-nav">
              <div class="case-studies-list-nav__prev icon__wrapper size--lg">
                @icon('chevron','nav-icon__prev icon--lg')
              </div>
              <div class="case-studies-list-nav__next icon__wrapper size--lg">
                @icon('chevron','icon nav-icon icon--lg')
              </div>
            </div>
          </div>
        </div>
        <div class="row -t-animate">
          <div class="col-12 col-lg-11 offset-lg-1">
            <div class="o-wrapper --pt-md">
              <div class="case-studies-slider__wrapper">
                <div class="swiper-container">
                  <div class="swiper-wrapper">

                    @while( $case_studies->query->have_posts() ) 
                      @php 
                        $case_studies->query->the_post();
                        $project_title = get_the_title();
                        $project_location = get_field('project_location');
                      @endphp


                      <div class="swiper-slide" data-index="{{ $key }}">
                        <div class="swiper-slide__content">
                          
                          <div class="project__header u-mb">
                            <div class="project__header-image">
                              @if ( has_post_thumbnail( ) )
                                {!! get_the_post_thumbnail( ) !!}
                              @else
                                {{-- placeholder --}}
                              @endif
                            </div>
                          </div>
                          <div class="project-info__wrapper">
                            <div class="project-info">
                              <h3>{!! $project_title !!}</h3>
                              <div class="project-location">
                                @icon('location','icon')
                                <span>{!! $project_location !!}</span>
                              </div>
                            </div>
                            <a href="{!! get_permalink() !!}" 
                               title="{!! __('View project', 'versilis-theme') . ' - ' . $project_title !!}"
                               class="btn --secondary">
                              {!! __('View', 'versilis-theme') !!}
                            </a>
                          </div>
                        </div>
                      </div>

                    @endwhile

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="case-studies__swiper-pagination u-mt-md"></div>
      </div>
    </div>
  </section>

@else
  <div class="row">
    <div class="col-12 u-mt-md">
      {{ __('No case study available yet.', 'versilis-theme') }}           
    </div>
  </div>
@endif

@php wp_reset_postdata(); @endphp