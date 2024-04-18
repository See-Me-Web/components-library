<x-seeme::wrapper 
  :size="$size ?? 'xl'"
  style="{{ $style }}"
  class="{{ $block->classes }}"
>
  <InnerBlocks />
</x-seeme::wrapper>