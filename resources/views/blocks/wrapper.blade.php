@props([
  'maxWidth' => 'md',
  'align' => 'center'
])

<x-seeme::wrapper 
  :maxWidth="$maxWidth"
  :align="$align"
  style="{{ $style }}"
  @class([
    'w-full',
    $block->classes 
  ])
>
  <InnerBlocks />
</x-seeme::wrapper>