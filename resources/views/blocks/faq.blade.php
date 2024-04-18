<section
  id="{{ $block->block->anchor ?? $block->block->id }}"
  style="{{ $style }}"
  @class([
    $block->classes,
  ])
>
  <InnerBlocks />
</section>