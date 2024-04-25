<x-seeme::wrapper 
  :size="$size ?? 'xl'"
  style="{{ $style }}"
  @class([
    'w-full',
    $block->classes 
  ])
>
  <InnerBlocks />
</x-seeme::wrapper>