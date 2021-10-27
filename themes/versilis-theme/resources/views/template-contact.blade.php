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

      <section class="contact-form -t-animate hatched-border">
        <div class="o-container --pb-xl">
          <div class="row">
            <div class="col-12 col-lg-6">
              <div class="o-wrapper --pt-md">
                <div class="contact-form__element">
                  @if ( !empty($form->contact_form) )
                    {!! do_shortcode($form->contact_form) !!}
                  @endif
                </div>
              </div>
            </div>
            
            @if ( $contact_info )
            <div class="col-12 offset-lg-1 col-lg-5">
              <div class="o-wrapper --pt-md">
                <div class="contact-info__intro">
                  <p>{!! $contact_info->text !!}</p>
                </div>
                <div class="contact-info__info">
                  <p>{!! $contact_info->info !!}</p>
                </div>
                <div class="contact-info__addresses">
                  {!! $contact_info->addresses !!}
                </div>

                <a href="#distributors" title="{!! __('See our distributors', 'versilis-theme') !!}" class="btn u-mt-sm">
                  {!! __('See our distributors', 'versilis-theme') !!}
                </a>
              </div>
            </div>
            @endif

          </div>
        </div>
      </section>

      @if( $distributors )
      <section id="distributors" class="distributors -t-animate">
        <div class="o-container --pt-xl --pb-xl">
          <div class="o-wrapper --pb-md">
            <h2>{{ __('Distributors', 'versilis-theme') }}</h2>
          </div>
          <div class="row justify-content-center">
            @foreach ( $distributors as $element)
              <div class="col-12 col-lg-6 col-xl-4 u-mb-sm">
                <div class="tile --dark">
                  <h3>{!! $element['location'] !!}</h3>
                  <div class="distributor__address">
                    <strong>{!! $element['name'] !!}</strong><br/>
                    {!! $element['address'] !!}
                  </div>
                  <div class="distributor__contact-info u-mt">
                    <div class="distributor__name">
                      @icon('user','icon')
                      <span>{!! $element['contact_name'] !!}</span>
                    </div>
                    <div class="distributor__phone">
                      @icon('phone','icon')
                      <span>{!! $element['phone'] !!}</span>
                    </div>
                    <div class="distributor__email">
                      @icon('email','icon')
                      <span>{!! $element['email'] !!}</span>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </section>
      @endif

    </div>

  @endwhile
@endsection
