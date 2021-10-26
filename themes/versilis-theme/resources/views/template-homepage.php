{{--
  Template Name: Homepage Template
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.page-header')
    
    <div class="o-main-container">
      {{-- Condition for margin if background is not light beige --}}
      <div class="o-container {!! ($page_header->background->color!='none') ? '--pt-xl ' : '' !!}--pb-xl">
        <div class="row">
          <div class="col-12 col-lg-10 col-xl-8">
            <div class="o-content">
              {!! $content !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  @endwhile
@endsection