<div 
  id="{{ $block->block->anchor ?? $block->block->id }}"
  @class([
    'flex flex-wrap gap-4',
    $block->classes
  ])
  style="{{ $style ?? '' }}"
>
  <InnerBlocks allowedBlocks="{{ wp_json_encode($allowedBlocks) }}" />
</div>