<div 
  id="{{ $block->block->anchor ?? $block->block->id }}"
  style="{{ $style }}"
  @class([
    'overflow-hidden w-full h-full',
    $block->classes,
  ])
  data-width="{{ $width }}"
>
  <InnerBlocks allowedBlocks="{{ wp_json_encode($allowedBlocks) }}" class="h-full" />
</div>