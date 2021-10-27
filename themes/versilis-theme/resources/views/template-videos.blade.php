{{--
  Template Name: Videos Template
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.page-header')
    
    <div class="o-main-container">

      @if( $videos )

      <div class="o-container --pt-xl --pb-xl">

        <div class="row">

          @foreach( $videos as $element )
            
            <div class="col-12 col-md-6 u-mt-sm">
              <div class="tile">
                <div class="video-wrapper">
                  {!! $element['video'] !!}
                </div>
                <div class="tile__content">
                  <h3 class="u-mb">{!! $element['title'] !!}</h3>
                  <div class="video__description">
                    {!! $element['description'] !!}
                  </div>
                </div>
              </div>
            </div>
        
          @endforeach

        </div>

      @endif

    </div>
  @endwhile
@endsection