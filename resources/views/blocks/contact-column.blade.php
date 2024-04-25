<div 
  id="{{ $block->block->anchor ?? $block->block->id }}"
  style="{{ $style }}"
  @class([
    'overflow-hidden w-full',
    $block->classes,
    'lg:max-w-[--width]'
  ])
  data-width="{{ $width }}"
>
  <InnerBlocks allowedBlocks="{{ wp_json_encode($allowedBlocks) }}"/>
</div>