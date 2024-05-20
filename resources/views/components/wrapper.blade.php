@props([
  'maxWidth' => 'md',
  'align' => 'center'
])

<div {{ $attributes->class([
    $classes ?? ''
  ])->merge([
    'style' => $styles ?? ''
  ]) }}
>
  {!! $slot !!}
</div>