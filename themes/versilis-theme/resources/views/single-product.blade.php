@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp

    {{-- Page header --}}
    @include('partials.product-header')

    <div class="o-main-container">


      {{-- Overview --}}

      <section class="product__overview">

        <div class="o-container --pt-sm --pb-md">
          <div class="row justify-content-between -t-animate">
            <div class="col-12 col-md u-mb">
              <a href="#" class="share-option with-icon" title="{{ __('Share by email', 'versilis-theme') }}">
                @icon('envelop','icon')
                <span>{{ __('Share by email', 'versilis-theme') }}</span>
              </a>
            </div>
            @if ( !empty($document_links) )
              <div class="col-12 col-md documents u-mb">
                @foreach ($document_links as $document)
                  <a href="{!! $document['file'] !!}" title="{!! __('Download', 'versilis-theme') . $document['name'] !!}" class="btn --with-icon --icon-left">
                    @icon('download','icon')
                    <span>{!! $document['name'] !!}</span>
                  </a>
                @endforeach
              </div>     
            @endif
          </div>
        </div>

        <div class="o-container --pb-xl">

          <div class="row">
            <div class="col-12 u-text-center -t-animate">
              <h2 class="u-mb-sm">{!! $overview['title'] !!}</h2>
            </div>
          </div>

          @foreach($overview['content'] as $key => $element)
            @php 
              $element = (object) $element;
              $pattern_alignment = '';
              if ($element->image['image_pattern']!=='') {
                $pattern_alignment = ($element->image['align']=='align-right') ? 'pattern-right' : 'pattern-left';
              }
            @endphp
              <div class="row justify-content-between align-items-center u-pb-sm -t-animate">
                
                <div class="col-12 col-lg-5 order-first {!! ($element->image['image_alignment']=='align-right') ? 'order-lg-first' : 'order-lg-last' !!} o-content">
                  <div class="o-wrapper --pt-sm o-content">
                    {!! $element->text !!}
                  </div>
                </div>
                <div class="col-12 col-lg-6 order-last {!! ($element->image['align']=='align-right') ? 'order-lg-last' : 'order-lg-first' !!}">
                    <div class="o-wrapper --pt-sm {!! $element->image['image_pattern'] !!} {!! $pattern_alignment !!}">
                      {!! wp_get_attachment_image( $element->image['image_file']['ID'], 'layout_img' ) !!}
                    </div>
                </div>

              </div>
            
          @endforeach

        </div>
      </section>

      <section class="product__related-services">
        <div class="o-container --pt-sm --pb-md">
          <div class="row justify-content-center -t-animate">
            
            @foreach( $related_services as $service )
              <div class="col-12 col-md-6 col-xl-4 u-mb-sm">
                <div class="tile --dark-bg">
                  <h4 class="small-label">{!! $service['label'] !!}</h4>
                  <h3 class="u-mb">{!! $service['title'] !!}</h3>
                  <div class="related-service__content">
                    {!! $service['text'] !!}
                  </div>
                  <a
                    href="{!! $service['link']['url'] !!}"
                    class="btn {!! !empty($button_classes) ? $button_classes : '' !!} --secondary-light u-mt-sm"
                    title="{!! __('Learn more about', 'versilis-theme') !!} {!! $service['title'] !!}">
                    {!! __('Learn more', 'versilis-theme') !!}
                  </a>
                </div>
              </div>
            @endforeach
            
          </div>
        </div>
      </section>

      {{-- Video --}}
      
      @if ( !empty($videos) )
      <section class="product__videos">

        <div class="product__videos__content">
          <div class="product__videos__row justify-content-end">
            <div class="product__videos__right-container">
              <div class="product__videos__el-text">
                <h2>{!! $videos['title'] !!}</h2>
              </div>
            </div>
          </div>

          <div class="product__videos__row">
            <div class="product__videos__el-video -t-animate order-last order-lg-first">
              {!! responsive_video($videos['videos'][0]) !!}
            </div>

            <div class="product__videos__right-container">
              <div class="product__videos__el-text">
                <div class="o-wrapper --pt-sm --pb-lg">
                  <div class="o-content">
                    {!! $videos['text'] !!}
                  </div>
                </div>
              </div>

              @if ( !empty($videos['videos'][1]) )
              <div class="product__videos__el-video-2 -t-animate">
                {!! responsive_video($videos['videos'][1]) !!}
              </div>
              @endif
            </div>

          </div>
        </div>     
                          
      </section>
      @endif

      @if ( !empty($applications['elements']) )
      <section class="project__applications">

        <div class="project__applications__content-wrapper -t-animate">
          <div class="o-container --pt-xl --pb-xl">
            <div class="row -t-animate justify-content-center">
              <div class="col-12 col-lg-6">        
                <h2 class="u-mb">{!! $applications['title'] !!}</h2>
              </div>
              <div class="col-12 col-lg-6">        
                <div class="project__applications-nav">
                  <div class="project__applications-nav__prev icon__wrapper size--lg">
                    @icon('chevron','nav-icon__prev icon--lg')
                  </div>
                  <div class="project__applications-nav__next icon__wrapper size--lg">
                    @icon('chevron','icon nav-icon icon--lg')
                  </div>
                </div>
              </div>
            </div>
            <div class="row -t-animate">
              <div class="col-12">
                <div class="o-wrapper --pt-md">
                  <div class="project__applications-slider__wrapper">
                    <div class="swiper-container">
                      <div class="swiper-wrapper">
    
                        @foreach ($applications['elements'] as $application)
    
                          <div class="swiper-slide" data-index="{{ $key }}">
                            <div class="tile --grey-bg">
                              <h3 class="u-mb">{!! $application->name !!}</h3>
                              <p class="u-mb">{!! $application->description !!}</p>
                              <a
                                href="{!! get_permalink(get_field('case_studies_page', 'option')) . '?application=' . $application->term_id !!}"
                                class="btn {!! !empty($button_classes) ? $button_classes : '' !!} --secondary"
                                title="">
                                {!! __('See related case studies', 'versilis-theme') !!}
                              </a>
                            </div>
                          </div>
    
                        @endforeach
    
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="project__applications__swiper-pagination u-mt-md"></div>
          </div>
        </div>
      </section>
      @endif

      {{-- Photo gallery --}}

      @if ( !empty($photos) )
      <section class="product__photos">

        <div class="o-container --pt-xl {!! (!empty($photos)) ? '--pb' : '--pb-xl' !!}">
            
          <div class="row justify-content-center">
            <div class="col-12 d-none d-md-block">
              <div class="product__photos__gallery">
                @foreach ($photos as $key => $image_id)
                  <div class="gallery-item">
                    <a href="#" data-img-num="{!! $key !!}">
                      <div data-src="{!! wp_get_attachment_image_url( $image_id, 'full' ); !!}" data-img-num="{!! $key !!}" class="gallery-item_img">
                      </div>
                    </a>
                  </div>
                @endforeach
                </div>
            </div>

            <div class="col-12 d-block d-md-none">
              <div class="mobile-photos-gallery">
                <div class="row -t-animate justify-content-center">
                  <div class="col-12 col-lg-6">        
                    <div class="mobile-photos-gallery-nav">
                      <div class="mobile-photos-gallery__prev icon__wrapper size--lg">
                        @icon('chevron','nav-icon__prev icon--lg')
                      </div>
                      <div class="mobile-photos-gallery__next icon__wrapper size--lg">
                        @icon('chevron','icon nav-icon icon--lg')
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row -t-animate">
                  <div class="col-12">
                    <div class="o-wrapper --pt-md">
                      <div class="mobile-photos-gallery-slider__wrapper">
                        <div class="swiper-container">
                          <div class="swiper-wrapper">
        
                            @foreach ($photos as $image_id)

                            <div class="swiper-slide" data-index="{{ $key }}">
                              <img data-src="{!! wp_get_attachment_image_url( $image_id, 'full' ); !!}" class="swiper-lazy">
                              <div class="swiper-lazy-preloader"></div>
                            </div>

                            @endforeach
        
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="photo-gallery" class="is-hidden">
          <a href="#" class="close-btn">
            @icon('close','icon nav-icon icon--lg')
          </a>
          <div class="o-container">
            <div class="row justify-content-center">
              <div class="col-10">
                <div class="photo-gallery-container">
                  <div class="photo-gallery-slider__wrapper">
                    <div class="photo-gallery-nav__prev icon__wrapper size--lg">
                      @icon('chevron','nav-icon__prev icon--lg')
                    </div>
                    <div class="photo-gallery-nav__next icon__wrapper size--lg">
                      @icon('chevron','icon nav-icon icon--lg')
                    </div>
                    <div class="swiper-container">
                      <div class="swiper-wrapper">

                        @foreach ($photos as $image_id)

                          <div class="swiper-slide" data-index="{{ $key }}">
                            <div data-background="{!! wp_get_attachment_image_url( $image_id, 'full' ); !!}" class="swiper-lazy photo-gallery-item">
                              <div class="swiper-lazy-preloader"></div>
                            </div>
                          </div>

                        @endforeach

                      </div>
                    </div>
                  </div>
                  <div class="photo-gallery__swiper-pagination u-mt"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      @endif


      {{-- FAQ --}}
      @if ( !empty($faq) )
      <section class="product__faq {!! (empty($photos)) ? 'bg-top-hatched' : '' !!}">

        <div class="o-container --pt-xl">

          <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8 col-xl-6 -t-animate">
              <div class="o-wrapper u-text-center --pb-md">
                <h2>{{ __('FAQ', 'versilis-theme') }}</h2>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12 -t-animate">
              <div class="faq-wrapper">
                <div class="row justify-content-center">
                  <div class="col-12 col-lg-10 -t-animate">
                    <div
                      id="faq"
                      class="toggle-group"
                    >
                      @foreach($faq as $key => $element)
                          <div class="toggle__element">
                            <div class="toggle__element-header">
                              <a 
                                href="#"
                                class="toggle__element-link"
                                data-toggle="toggle-trigger"
                                data-target="#answer-{!! $key !!}"
                                aria-expanded="false"
                                aria-controls="answer-{!! $key !!}"  
                              >
                                <h3 class="u-mb-none">{!! $element['question'] !!}</h3>
                              </a>
                            </div>
                            <div id="answer-{!! $key !!}" class="o-content toggle__element-content">
                              <div class="row">
                                <div class="col-12">
                                  {!! $element['answer'] !!}
                                </div>
                            </div>
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
          
      </section>

      @endif
  

      {{-- Case studies --}}
    
      @if ( !empty($case_studies) )

        @include('partials.case-studies')

      @endif

      {{-- Call to action --}}
      
      @php $content_block = $call_to_action @endphp
      @include('partials.content-flexible.call_to_action')
      
    </div>

  @endwhile
@endsection
