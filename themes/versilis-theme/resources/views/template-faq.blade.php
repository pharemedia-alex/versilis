{{--
  Template Name: FAQ Template
--}}

@php
  $content_block = $call_to_action;
@endphp

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.page-header')

    <div class="o-main-container">

      <section class="cf-faq">
        <div class="o-container --pb-xl">
          <div class="row">
            <div class="col-12 -t-animate">
              <div
                id="cf-faq-accordion"
                class="toggle-group"
              >
                @foreach($questions as $key => $element)
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
                          <div class="{{ ( !empty($element['answer_image']) ) ? 'col-lg-5' : '' }} col-11 u-pb-sm">
                            {!! $element['answer'] !!}
                          </div>
                        @if ( !empty($element['answer_image']) )
                          <div class="col-12 col-lg-6 u-pb-sm">
                            {!! wp_get_attachment_image( $element['answer_image'], 'large' ) !!}
                          </div>
                        @endif
                      </div>
                    </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </section>
      
      @include('partials.content-flexible')

    </div>

  @endwhile
@endsection
