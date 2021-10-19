<a 
  id="{!! ( !empty($button_id )) ? 'id="'. $button_id .'"' : '' !!}"
  href="{!! $button_content->url !!}"
  class="btn {!! !empty($button_classes) ? $button_classes : '' !!}"
  title="{!! $button_content->title !!}"
  {!! ( !empty($button_content->target ) && $button_content->target==true ) ? 'target="_blank" rel="noopener"' : '' !!}>
  {!! $button_content->title !!}
</a>