<section 
  id="{{ $block->block->anchor ?? $block->block->id }}"
  style="{{ $style }}"
  @class([
    'overflow-hidden',
    $block->classes,
  ])
>
  @include('seeme::partials.styles.background')

  <InnerBlocks />
</section>