@props([
  'maxWidth' => 'md'
])

<div {{ $attributes->class([
  $classes
]) }}>
  {!! $slot !!}
</div>