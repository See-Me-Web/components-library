<div 
  id="{{ $block->block->anchor ?? $block->block->id }}"
  @class([
    $block->classes
  ])
  style="{{ $style ?? '' }}"
>
  <InnerBlocks />
</div>