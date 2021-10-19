

@if( !empty($case_studies->results) )

  <section class="case-studies-list">

    <div class="home-services__content-wrapper -t-animate">
      <div class="o-container --pt-lg">
        <div class="row">
          <div class="col-12 col-lg-4">
            <div class="nav-wrapper">
              {{------------------------- Title ------------------------}}
              <h2 class="h3">{!! $case_studies->title !!}</h2>

              {{------------------------- Swiper navigation arrows ------------------------}}
              {{--
              <div class="home-services-nav">
                <div class="home-services-nav__prev icon__wrapper size--xl">
                  @icon('nav','nav-icon__prev icon--full-size')
                </div>
                <div class="home-services-nav__next icon__wrapper size--xl">
                  @icon('nav','icon nav-icon icon--full-size')
                </div>
              </div>
              <div class="home-services-nav-mobile">
                <div class="home-services-nav__prev icon__wrapper size--xl">
                  @icon('nav','nav-icon__prev icon--full-size')
                </div>
                <h2 class="h3">{!! $case_studies->intro !!}</h2>
                <div class="home-services-nav__next icon__wrapper size--xl">
                  @icon('nav','icon nav-icon icon--full-size')
                </div>
              </div>
              --}}
            </div>
          </div>
          <div class="col-12 col-lg-7">
            <div class="o-wrapper --pb-lg">
              <div class="home-services-slider__wrapper">
                <div class="swiper-container">
                  <div class="swiper-wrapper">

                    @foreach ($case_studies->results as $key => $element)


                      <div class="swiper-slide" data-index="{{ $key }}">
                        <div class="swiper-slide__content">
                          
                          featured image

                          {!! $element->post_title !!}
                          <a 
                            href="{!! get_permalink($element->post_id) !!}"
                            title="{!! get_the_title() !!}">{!! __('View', 'versilis-theme') !!}</a>
                          
                        </div>
                      </div>

                    @endforeach

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="home-services__swiper-pagination"></div>
    </div>
  </section>

@endif