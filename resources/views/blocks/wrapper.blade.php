@props([
  'maxWidth' => 'md'
])

<x-seeme::wrapper 
  :maxWidth="$maxWidth"
  style="{{ $style }}"
  @class([
    'w-full',
    $block->classes 
  ])
>
  <InnerBlocks />
</x-seeme::wrapper>