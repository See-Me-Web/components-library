@php
  $classes = $block->classes ?? '';
  $classes .= ' !inline-flex';

  $cssStyles = $customWidth ? "min-width: {$width}px" : '';
@endphp

<x-button-link
  :href="$link['url'] ?? '#'"
  :target="$link['target'] ?? '_self'"
  :style="$style ?? 'primary'"
  :size="$size ?? 'medium'"
  :class="$classes"
  :css-styles="$cssStyles"
>
  @if ($iconBefore)
    <x-slot name="iconLeft">
      @svg($iconBefore, 'w-5 h-5')
    </x-slot>
  @endif

  {!! $link['title'] ?? 'Button' !!}

  @if ($iconAfter)
    <x-slot name="iconRight">
      @svg($iconAfter, 'w-5 h-5')
    </x-slot>
  @endif
</x-button-link>
