@props([
  'size' => '',
  'weight' => '',
  'text' => '',
  'element' => ''
])

<x-seeme::heading
  :headingSize="$element"
  id="{{ $block->block->anchor ?? $block->block->id }}"
  :size="$size"
  :weight="$weight"
  :class="Arr::toCssClasses([
    $block->classes
  ])"
  style="{{ $style }}"
>
  {!! $text !!}
</x-seeme::heading>