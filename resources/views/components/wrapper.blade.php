@props([
  'size' => 'xl'
])

<div {{ $attributes->class([
  $classes,
  'mx-auto'
]) }}>
  {!! $slot !!}
</div>