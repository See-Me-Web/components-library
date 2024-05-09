@props([
  'size' => '',
  'weight' => '',
  'text' => '',
  'element' => ''
])

<x-seeme::heading
  id="{{ $block->block->anchor ?? $block->block->id }}"
  :size="$size"
  :element="$element"
  :weight="$weight"
  :class="Arr::toCssClasses([
    $block->classes
  ])"
  style="{{ $style }}"
>
  {!! $text !!}
</x-seeme::heading>