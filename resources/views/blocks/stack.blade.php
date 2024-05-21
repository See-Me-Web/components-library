<div 
  id="{{ $block->block->anchor ?? $block->block->id }}"
  @class([
    'flex flex-wrap',
    'flex-col' => $vertical,
    'flex-row' => ! $vertical,
    $block->classes
  ])
  style="{{ $style ?? '' }}"
>
  <InnerBlocks />
</div>