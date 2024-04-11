<x-seeme::heading
  id="{{ $block->block->anchor ?? $block->block->id }}"
  :size="$size ?? 'md'"
  :element="$element ?? 'h3'"
  :class="Arr::toCssClasses([
    $block->classes
  ])"
  style="{{ $block->style }}"
>
  {!! $text !!}
</x-seeme::heading>