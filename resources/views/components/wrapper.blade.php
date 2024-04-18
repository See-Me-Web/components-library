@props([
  'size' => 'xl'
])

<div {{ $attributes->class([
  $classes
]) }}>
  {!! $slot !!}
</div>