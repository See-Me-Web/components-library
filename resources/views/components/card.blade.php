<div {{ $attributes->class([
  'card overflow-hidden',
  $classes ?? ''
])->merge([
  'style' => $styles ?? ''
]) }}
>
  {{ $slot }}
</div>