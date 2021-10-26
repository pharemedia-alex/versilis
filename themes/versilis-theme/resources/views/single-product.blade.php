@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp

    {{-- Page header --}}
    @include('partials.page-header')

    <div class="o-main-container">


      {{-- Overview --}}

      <section class="product__overview">

        <div class="o-container --pt-sm --pb-md">
          <div class="row justify-content-betweeb=n">
            <div class="col-12 col-lg">
              <a href="#" class="share-option with-icon" title="{{ __('Share by email', 'versilis-theme') }}">
                @icon('envelop','icon')
                <span>{{ __('Share by email', 'versilis-theme') }}</span>
              </a>
            </div>
            @if ( !empty($document_links) )
              <div class="col-12 col-lg documents">
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
            <div class="col-12 u-text-center">
              <h2 class="u-mb-sm">{!! $overview['title'] !!}</h2>
            </div>
          </div>

          @foreach($overview['content'] as $key => $element)
            @php $element = (object) $element; @endphp

              <div class="row justify-content-between align-items-center u-pb-sm">
                
                <div class="col-12 col-lg-5 order-first {!! ($element->image['image_alignment']=='align-right') ? 'order-lg-first' : 'order-lg-last' !!} -t-animate o-content">
                  <div class="o-wrapper --pt-sm o-content">
                    {!! $element->text !!}
                  </div>
                </div>

                <div class="col-12 col-lg-6 -t-animate order-last {!! ($element->image['align']=='align-right') ? 'order-lg-last' : 'order-lg-first' !!}">
                    <div class="o-wrapper --pt-sm">
                      {!! wp_get_attachment_image( $element->image['image_file']['ID'], 'layout_img' ) !!}
                    </div>
                </div>

              </div>
            
          @endforeach

        </div>
      </section>

      <section class="project__applications">
        <div class="o-container --pb-xl --pt-xl">
          <div class="row">
            <div class="col-12 col-lg-6">
              <h2></h2>
            </div>
          </div>
          <div class="row">
            @if ( !empty($applications['elements']) )
              @foreach ($applications['elements'] as $application)
                <div class="col">
                  <div class="tile" data-traverse="-in-viewport" style="transition-delay: 0.374956s;">
                    <h3 class="u-mb">{!! $application->name !!}</h3>
                    <p class="u-mb">{!! $application->description !!}</p>
                    <a
                      href="{!! get_permalink(get_field('case_studies_page', 'option')) . '?application=' . $application->term_id !!}"
                      class="btn {!! !empty($button_classes) ? $button_classes : '' !!}"
                      title="">
                      {!! __('Learn more', 'versilis-theme') !!}
                    </a>
                  </div>
                </div>
              @endforeach
            @endif
          </div>
        </div>
      </div>

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
      <section class="project__photos">

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


      {{-- FAQ --}}
      @if ($faq)
      <section class="project__faq">

        <div class="o-container --pt-xl">

          <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8 col-xl-6 -t-animate">
              <div class="o-wrapper u-text-center --pb-sm">
                <h2>{{ __('FAQ', 'versilis-theme') }}</h2>
              </div>
            </div>
          </div>

          <div class="row justify-content-center">

            <div class="col-12 col-lg-10 -t-animate">
              @foreach ($faq as $element)
                <div class="project__faq__element">
                  <div class="question">
                    <strong>{!! $element['question'] !!}</strong>
                  </div>
                  <div class="answer">
                    {!! $element['answer'] !!}
                  </div>
                </div>
              @endforeach
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
