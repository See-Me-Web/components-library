<x-seeme::card 
  id="{{ $block->block->anchor ?? $block->block->id }}"
  @class([
    $block->classes
  ])
  style="{{ $style ?? '' }}"
  :variant="$variant ?? 'primary'"
>
  <InnerBlocks />
</x-seeme::card>