@if(isset($block->styles_support) && in_array('background', $block->styles_support))
  @include('seeme::partials.styles.background') 
@endif