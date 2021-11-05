<header class="header">
  <div class="header-init">
    <div class="header__content">
      <div class="header__main">
        <a class="brand" href="{{ home_url('/') }}" title="{{ get_bloginfo('name', 'display') }}">
          @include('partials.logo')
        </a>
        <nav class="nav-primary">
          @if (has_nav_menu('primary_navigation'))
            {!! App::get_mega_menu('primary_navigation', 'main-menu') !!}
          @endif
        </nav>
        <a href="{!! get_permalink($contact_link->page->ID) !!}" title="{!! $contact_link->menu_label !!}" class="header__cta btn">{!! $contact_link->menu_label !!}</a>
        <button
          aria-expanded="false"
          aria-haspopup="true"
          aria-controls="mainMenu"
          class="nav-toggle"
          data-js="menuToggle"
          type="button"
        >
          <div class="bar"></div>
          <div class="bar"></div>
          <div class="bar"></div>
          {{-- accessibility <span aria-hidden="true" class="visible-sr">{{ __('Ouvrir le menu', 'versilis-theme') }}</span> --}}
        </button>
      </div>
    </div>
  </div>

  <div id="mobile-menu" class="menu overlay" role="menu" data-active="">
    <div class="o-container --pt">
      <a class="brand" href="{{ home_url('/') }}" title="{{ get_bloginfo('name', 'display') }}">
        @include('partials.logo', ['header_logo' => ''] )
      </a>
      @if ( has_nav_menu('primary_navigation') )
        <nav class="nav-primary">
          @if (has_nav_menu('primary_navigation'))
            {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav -t-menu']) !!}
          @endif
        </nav>
      @endif
      <a href="{!! get_permalink($contact_link->page->ID) !!}" title="{!! $contact_link->menu_label !!}" class="header__cta btn">{!! $contact_link->menu_label !!}</a>
    </div>
  </div>

</header>
