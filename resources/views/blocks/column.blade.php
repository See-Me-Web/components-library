<div 
  id="{{ $block->block->anchor ?? $block->block->id }}"
  @class([
    $block->classes
  ])
  style="{{ $style ?? '' }}"
  data-col-span="{{ $colSpan ?? 1 }}"
>
  <InnerBlocks />
</div>