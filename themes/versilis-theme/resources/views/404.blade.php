@extends('layouts.app')

@section('content')

  @if (!have_posts())
  
  @php
    $page_header = new \stdClass();
    $page_header->content = new \stdClass();
    $page_header->content->title = __('Page unavailable', 'versilis-theme');
    $page_header->content->subtitle = __('We are sorry, the page you were trying to view does not exist.', 'versilis-theme');
  @endphp

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
  @endif
@endsection
