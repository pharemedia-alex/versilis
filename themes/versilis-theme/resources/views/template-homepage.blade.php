{{--
  Template Name: Homepage Template
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.home-header')

    {{-- Products --}}

    <section class="products">
      
    </section>
    
    {{-- Highlight --}}

    @if ( !empty($highlight['title']) )

    <section class="highlight">
      <div class="o-container --pt-xl --pb-md">
        <div class="row justify-content-end">
          <div class="words">
            <div>{!! __('safety', 'versilis-theme') !!}</div>
            <div>{!! __('Crash tested', 'versilis-theme') !!}</div>
            <div>{!! __('Control', 'versilis-theme') !!}</div>
          </div>
          <div class="col-12 col-xl-6">
            <h2>{!! $highlight['title'] !!}</h2>
            <div class="highlight__text">{!! $highlight['text'] !!}</div>
            <a href="{!! $highlight['link']['url'] !!}"
               class="highlight__link"
               title="{!! $highlight['link']['title'] !!}">
               {!! $highlight['link']['title'] !!}
            </a>
          </div>
        </div>
    </section>

    @endif

    {{-- Innovation --}}

    <section class="innovation">

      <div class="innovation__content-wrapper -t-animate">
        <div class="o-container --pt-xl --pb-xl">
          <div class="row">
            <div class="col-12 col-lg-6">        
              <h2 class="u-mb">{!! $innovation['title'] !!}</h2>
              <div class="innovation__intro">{!! $innovation['text'] !!}</div>
            </div>
          </div>
          <div class="row align-items-end">
            <div class="col">
              <a href="{!! $innovation['link']['url'] !!}"
                 title="{!! $innovation['link']['title'] !!}"
                 target="{!! $innovation['link']['target'] !!}"
                 class="btn u-mt-sm">
                 {!! $innovation['link']['title'] !!}
              </a>
            </div>
            <div class="col">
              <div class="innovation-list-nav">
                <div class="innovation-list-nav__prev icon__wrapper size--lg">
                  @icon('chevron','nav-icon__prev icon--lg')
                </div>
                <div class="innovation-list-nav__next icon__wrapper size--lg">
                  @icon('chevron','icon nav-icon icon--lg')
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-lg-11 offset-lg-1">
              <div class="o-wrapper --pt-md --pb-sm">
                <div class="innovation-list-slider__wrapper">
                  <div class="swiper-container">
                    <div class="swiper-wrapper">
  
                      @foreach( $innovation['elements'] as $key => $element ) 
                        
                        <div class="swiper-slide" data-index="{{ $key }}">
                          <div class="innovation-element">
                            <div class="left">
                              <h3 class="u-mb-sm">{!! $element['title'] !!}</h3>
                              {!! $element['text'] !!}
                              <div class="logo u-mt-sm">
                                {!! wp_get_attachment_image( $element['logo'], 'layout_img' ) !!}
                              </div>
                              <a href="{!! $element['link']['url'] !!}"
                                  title="{!! $element['link']['title'] !!}"
                                  target="{!! $element['link']['target'] !!}"
                                  class="btn u-mt-sm">
                                  {!! $element['link']['title'] !!}
                              </a>
                            </div>
                            <div class="right">
                              {!! wp_get_attachment_image( $element['image'], 'layout_img' ) !!}
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
          <div class="innovation-list__swiper-pagination"></div>
        </div>
      </div>
      
    </section>

    {{-- Map --}}

    @if ( !empty($map['title']) )

      <section class="map">
        <div class="o-container --pb-md --pt-xl">
          <div class="row justify-content-center">
            <div class="col-12 col-xl-6">
              <h2 class="u-mb-md">{!! $map['title'] !!}</h2>
            </div>
          </div>
          <div class="row justify-content-center map-bg">
            <div class="col-12">
              <div class="map__info__wrapper">
                <div class="map__info">
                  <div class="map__info__number">{!! $map['map_info_1']['number'] !!}</div>
                  <div class="map__info__descr">{!! $map['map_info_1']['description'] !!}</div>
                </div>
      
                <div class="map__info">
                  <div class="map__info__number">{!! $map['map_info_2']['number'] !!}</div>
                  <div class="map__info__descr">{!! $map['map_info_2']['description'] !!}</div>
                </div>
      
                <div class="map__info">
                  <div class="map__info__number">{!! $map['map_info_3']['number'] !!}</div>
                  <div class="map__info__descr">{!! $map['map_info_3']['description'] !!}</div>
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
    
  @endwhile
@endsection