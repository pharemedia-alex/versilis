@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp

    {{-- Page header --}}
    @include('partials.page-header')

    <div class="o-main-container">


      {{-- Overview --}}

      <section class="case-study__overview">

      @foreach($overview as $key => $element)
        @php $element = (object) $element; @endphp

        <div class="o-container --pb-xl --pt-xl">
          <div class="row justify-content-between align-items-center">
            
            <div class="col-12 col-lg-5 -t-animate o-content">
              @if ( $key === array_key_first($overview) )
                <h4 class="label">{{ __('Overview', 'versilis-theme') }}</h4>
              @endif
              {!! $element->text !!}
            </div>

            <div class="col-12 col-lg-6 -t-animate">
              <div class="order-last {!! ($element->image['align']=='right') ? 'order-lg-last' : 'order-lg-first' !!}">
                <div class="o-wrapper">
                  {!! wp_get_attachment_image( $element->image['image_file']['ID'], 'layout_img' ) !!}
                </div>
              </div>
            </div>

          </div>
        </div>
        
      @endforeach

      </section>


      {{-- Scope --}}

      <section class="case-study__scope">

        <div class="o-container --pt-xl">
                      
          @if ( !empty($scope->main_title))

          <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8 col-xl-6 -t-animate">
              <div class="o-wrapper u-text-center --pb-sm">
                <h4 class="label">{{ __('Project scope', 'versilis-theme') }}</h4>
                <h2>{!! $scope->main_title !!}</h2>
              </div>
            </div>
          </div>

          @endif

          <div class="row justify-content-center">

            <div class="col-12 col-lg-5 -t-animate">
              <div class="o-wrapper --pb-md">
                <div class="o-content">
                  {!! $scope->text_left !!}
                </div>
              </div>
            </div>

            <div class="col-12 col-lg-5 -t-animate o-content">
              <div class="o-wrapper --pb-md">
                <div class="o-content">
                  {!! $scope->text_right !!}
                </div>
              </div>
            </div>
  
          </div>

          @if ( !empty($scope->img_left) || !empty($scope->img_right) )
          <div class="row justify-content-center">
              
            @if ( !empty($scope->img_left) )
            <div class="col-12 col-lg-5 -t-animate">
              <div class="o-wrapper">
                {!! wp_get_attachment_image( $scope->img_left['ID'], 'layout_img' ) !!}
              </div>
            </div>
            @endif

            @if ( !empty($scope->img_right) )
            <div class="col-12 col-lg-5 -t-animate">
              <div class="o-wrapper">
                {!! wp_get_attachment_image( $scope->img_left['ID'], 'layout_img' ) !!}
              </div>
            </div>
            @endif

          </div>
          @endif
        
        </div>
          
      </section>
  

      {{-- Benefits --}}

      <section class="case-study__benefits">

        <div class="o-container --pt-xl">
            
          @if ( !empty($benefits->main_title) )
          <div class="row justify-content-center">

            <div class="col-12 col-md-10 col-lg-8 col-xl-6 u-text-center -t-animate">
              <div class="o-wrapper u-text-center --pb-sm">
                <h4 class="label">{{ __('Benefits', 'versilis-theme') }}</h4>
                <h2>{!! $benefits->main_title !!}</h2>
              </div>
            </div>

          </div>
          @endif


          <div class="row justify-content-center align-items-stretch">

            @foreach($benefits->boxes as $key => $element)
            @php $element = (object) $element; @endphp
              
              <div class="col-12 col-lg-5 -t-animate">
                <div class="tile">
                  <div class="tile__content">
                    {!! $element->content !!}
                  </div>
                </div>
              </div>
              
            @endforeach
             
          </div>

        </div>
          
      </section>


      {{-- Video --}}

      @if ( !empty($video) )
      <section class="case-study__video">

        <div class="o-container --pt-xl --pb-xl">
            
          <div class="row justify-content-center">

              <div class="col-12 col-xl-10 -t-animate">
                {!! responsive_video($video->scalar) !!}
              </div>
              
          </div>

        </div>
          
      </section>
      @endif


      {{-- Photo gallery --}}

      @if ( !empty($photos) )
      <section class="case-study__photos">

        <div class="o-container --pt-xl --pb-xl">
            
          <div class="row justify-content-center">
            @dump($photos)
            @if( $photos )
              @foreach ($photos as $image_id)
                {!! wp_get_attachment_image( $image_id, 'full' ); !!} 
              @endforeach
            @endif
          </div>

        </div>
          
      </section>
      @endif


      {{-- Quote --}}

      <section class="case-study__testimonial">
        <div class="o-container">
          <div class="row -t-animate">
            <div class="col-12 col-lg-9">
              <div class="testimonial-wrapper">
                <div class="testimonial__content">
                  {!! $quote->content !!}
                </div>
                <div class="testimonial__signature">
                  <span class="person">{!! $quote->person !!}</span>
                  {!! ( !empty($quote->title) ) ? '- <span class="title">' . $quote->title . '</span>' : '' !!}{!! ( !empty($quote->company) ) ? '<span class="company">, ' . $quote->company  . '</span>' : '' !!}
                </div>
            </div>
          </div>
        </div>
      </section>

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
