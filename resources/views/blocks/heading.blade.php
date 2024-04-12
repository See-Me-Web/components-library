<x-seeme::heading
  id="{{ $block->block->anchor ?? $block->block->id }}"
  :size="$size ?? 'md'"
  :element="$element ?? 'h3'"
  :weight="$weight ?? 'normal'"
  :class="Arr::toCssClasses([
    $block->classes
  ])"
  style="{{ $style }}"
>
  {!! $text !!}
</x-seeme::heading>