{{--
  Template Name: Case Studies Template
--}}

@php

global $paged;
$paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
$page_url = parse_url($_SERVER['REQUEST_URI']);
$url_query_string = parse_str($page_url['query'], $query_strings);
$url = get_permalink(get_field('case_studies_page', 'options'));

$location_id = $query_strings['location'];
$product_id = $query_strings['product-id'];
$application_id = $query_strings['application'];

@endphp


@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.page-header')
    
    <div class="o-main-container">
      <div class="o-container --pt-md">
        <div class="row">
          <div class="col-12">
            <div class="filters-wrapper">
              <form class="filters">
                <span class="label">{{ __('Filter by', 'versilis-theme') }}</span>
                @if ( $filter_locations!==false )
                  <select name="location" id="location">
                    <option value="" {!! ($location_id=='') ? 'selected' : '' !!}>{{ __('Location', 'versilis-theme') }}</option>
                    @foreach ($filter_locations as $key => $location)
                      <option value="{{ $key }}" {!! ($location_id==$key) ? 'selected' : '' !!}>{!! $location !!}</option>    
                    @endforeach
                  </select>
                @endif

                @if ( !empty($filter_products) )
                  <select name="product-id" id="product-id">
                    <option value="" {!! ($product_id=='') ? 'selected' : '' !!}>{{ __('Product', 'versilis-theme') }}</option>
                    @foreach ($filter_products as $key => $product)
                      <option value="{{ $key }}" {!! ($product_id==$key) ? 'selected' : '' !!}>{!! $product !!}</option>    
                    @endforeach
                  </select>
                @endif

                @if ( !empty($filter_applications) )
                  <select name="application" id="application">
                    <option value="" {!! ($application_id=='') ? 'selected' : '' !!}>{{ __('Application', 'versilis-theme') }}</option>
                    @foreach ($filter_applications as $application)
                      <option value="{{ $application->term_id }}" {!! ($application_id==$application->term_id) ? 'selected' : '' !!}>{!! $application->name !!}</option>    
                    @endforeach
                  </select>
                @endif

              </span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="o-container --pb-xl results-wrapper">
      
      @include('partials.loop-case-studies')

    </div>
    
  </div>
  @endwhile
@endsection