<x-seeme::heading
  id="{{ $block->block->anchor ?? $block->block->id }}"
  :size="$size ?? 'md'"
  :element="$element ?? 'h3'"
  :class="Arr::toCssClasses([
    $classes
  ])"
  style="{{ $style }}"
>
  {!! $text !!}
</x-seeme::heading>