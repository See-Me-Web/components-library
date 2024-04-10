@props([
  'size' => 'md',
  'element' => 'h3' 
])

<{{ $element }}
  {{ $attributes->class([$classes ?? '']) }}
>
 {{ $slot }}
</{{ $element }}>