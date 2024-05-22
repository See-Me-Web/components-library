<div {{ $attributes->class([
  'overflow-hidden',
  $classes ?? ''
])->merge([
  'style' => $styles ?? ''
]) }}
  data-card-width="{{ $cardWidth ?? 1 }}"
>
  {{ $slot }}
</div>