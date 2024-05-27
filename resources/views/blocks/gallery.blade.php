<div 
  id="{{ $block->block->anchor ?? $block->block->id }}"
  @class([
    'grid gap-4',
    'has-nested-images',
    $block->classes,
  ])
  style="{{ $style ?? '' }}"
>
  <InnerBlocks allowedBlocks="{{ wp_json_encode($allowedBlocks) }}" />
</div>
