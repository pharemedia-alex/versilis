{{--
  Template Name: Contact Template
--}}

@php
  $content_block = $call_to_action;
@endphp

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.page-header')

    <div class="o-main-container">

      <section class="contact-form -t-animate">
          {{--
            <h2>{!! $form->title !!}</h2>
          @if( !empty($form->intro) )
            <p class="lead">
              {!! $form->intro !!}
            </p>
          @endif
          --}}
          <div class="contact-form__element">
            @if ( !empty($form->contact_form) )
              {!! do_shortcode($form->contact_form) !!}
            @endif
            
            <div class="o-container --pb-xl">
              <div class="row">
                <div class="col-12 -t-animate u-pb-md">
                  @if ( !empty($form->content) )
                    {!! $form->content !!}
                  @endif
                </div>
              </div>
            </div>
          </div>
      </section>

    </div>

  @endwhile
@endsection
