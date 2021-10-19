@foreach ($flexible_content as $content_block)
  @php $content_block = (object) $content_block @endphp
  @include("partials.content-flexible.".$content_block->acf_fc_layout)
@endforeach