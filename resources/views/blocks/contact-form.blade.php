@if(isset($form))
  <div 
    id="{{ $block->block->anchor ?? $block->block->id }}"
    style="{{ $style }}"
    @class([
      $block->classes,
    ])
  >
    {!! $form !!}
  </div>
@endif