{{--
  Template Name: Documents Template
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.page-header')
    
    <div class="o-main-container">

      @if( $sections )

        @foreach( $sections as $key => $section )
          
          <div class="o-container {{ ( $key===0 ) ? "--pt-xl" : "" }} --pb-xl">
            
            @if ( !empty($section['main_title']) )
              <div class="row u-mb-md">
                <div class="col-12 col-lg-10 col-xl-8">
                  <h2>{!! $section['main_title'] !!}</h2>
                </div>
              </div>
            @endif

            @foreach( $section['categories'] as $category )

              @if ( !empty($category['title']) )
                <div class="row u-mb-sm u-mt-sm">
                  <div class="col-12 col-lg-10 col-xl-8">
                    <h3>{!! $category['title'] !!}</h3>
                  </div>
                </div>
              @endif

              <div class="row">
              
                @foreach( $category['documents'] as $doc )
                  <div class="col-12 col-lg-6 u-mb-sm">
                    <a href="{!! $doc['file'] !!}" class="document" title="{!! $doc['title'] !!}">
                      <div class="document__info">
                        <span class="document__title">{!! $doc['title'] !!}<br/>
                        <span class="document__description">{!! $doc['description'] !!}</span>
                      </div>
                      @icon('download', 'icon icon--md')
                    </a>
                  </div>
                
                @endforeach
                
              </div>             

            @endforeach

          </div>

        @endforeach

      @endif
    </div>
  @endwhile
@endsection