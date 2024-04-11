<x-seeme::heading
  id="{{ $block->block->anchor ?? $block->block->id }}"
  :size="$size"
  :element="$element"
  :class="Arr::toCssClasses([
    $block->classes
  ])"
  style="{{ $block->style }}"
>
  {!! $text !!}
</x-seeme::heading>