<div {{ $attributes->class([
  'overflow-hidden',
  $classes ?? ''
])->merge([
  'style' => $styles ?? ''
]) }}
>
  {{ $slot }}
</div>