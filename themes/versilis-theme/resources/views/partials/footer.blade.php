<footer class="footer">
  <div class="o-container --pt-lg">
    <div class="row align-items-stretch">
      <div class="col-12 col-lg-7">
        <div class="footer-col">
          @if (has_nav_menu('footer_navigation'))
            {!! wp_nav_menu('footer_navigation') !!}
          @endif
        </div>
      </div>

      <div class="col-12 col-lg-3">
        <div class="footer-col o-wrapper u-pb-sm">
          <div class="footer-col_content">
            {!! $footer->footer_contact_info !!}
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="o-container-fluid">
    <div class="sub-footer">
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
</footer>
