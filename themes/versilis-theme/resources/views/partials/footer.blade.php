<footer class="footer">
  <div class="o-container --pt-lg">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-12 col-xl-10">
        <div class="row">
          <div class="col-12 col-md-6 col-lg-4">
            <div class="o-wrapper --pb-sm">
              <h4>{!! $footer['address']['title'] !!}</h4>
              <div class="address">{!! $footer['address']['content'] !!}</div>
            </div>
          </div>
    
          @php dynamic_sidebar( 'sidebar-footer' ) @endphp
    
          <div class="col-12 col-md-6 col-lg-2">
            <div class="o-wrapper --pb-sm social-media">
              <h4>{!! $footer['social_media']['title'] !!}</h4>
    
              @if ( !empty($footer['social_media']['url_linkedin']) )
                <a href="{!! $footer['social_media']['url_linkedin'] !!}" title="{!! __("Follow Versilis on LinkedIn", "versilis-theme") !!}" target="_blank">
                  <div class="icon__wrapper">
                    @icon('linkedin','icon--size-md')
                  </div>
                </a>
              @endif
    
              @if ( !empty($footer['social_media']['url_youtube']) )
                <a href="{!! $footer['social_media']['url_youtube'] !!}" title="{!! __("Follow Versilis on Youtube", "versilis-theme") !!}" target="_blank">
                  <div class="icon__wrapper">
                    @icon('youtube','icon--size-md')
                  </div>
                </a>
              @endif
    
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-12 col-lg-12 col-xl-10">
        <div class="row align-items-center membership-logo">
          <div class="col-12 col-md-6 col-lg">
            <div class="o-wrapper --pb-sm">
              {!! __("Association Membership", "versilis-theme") !!}
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg">
            <div class="o-wrapper --pb-sm">
              <img src="@asset('images/ibtta_logo.png')" alt="{{ __("IBTTA", "versilis-theme") }}" />
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg">
            <div class="o-wrapper --pb-sm">
              <img src="@asset('images/itsamerica_logo.png')" alt="{{ __("ITS America", "versilis-theme") }}" />
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg">
            <div class="o-wrapper --pb-sm">
              {!! __("TRB Committee Involvement: Roadside Safety Design (AKD20) & Managed Lanes (ACP35)", "versilis-theme") !!}
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg">
            <div class="o-wrapper --pb-sm">
              <img src="@asset('images/TRB_logo.png')" alt="{{ __("Transportation Reduce Board", "versilis-theme") }}" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="sub-footer">
    <div class="o-container-fluid">
      <div class="sub-footer__content">
        <div class="col">
          <div class="copyright">&copy; {!! date("Y"). ' ' . __('Versilis inc.', 'versilis-theme') !!}</div>
        </div>

        <div class="col">
          <div class="links">
            <span><?php _e('Created by <a href="https://www.pharemedia.com/" title="Created by PHARE MEDIA" target="_blank">PHARE MEDIA</a>', 'versilis-theme'); ?></span>
            <a href="{!! get_privacy_policy_url() !!}" title="{!! __("Terms of use", "versilis-theme") !!}">{!! __("Terms of use", "versilis-theme") !!}</a>
            <a href="{!! get_privacy_policy_url() !!}" title="{!! __("Privacy Policy", "versilis-theme") !!}">{!! __("Privacy Policy", "versilis-theme") !!}</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
