@props([
  'maxWidth' => 'md',
  'align' => 'center'
])

<div {{ $attributes->class([
  $classes
]) }}>
  {!! $slot !!}
</div>