@props([
  'size' => 'md',
  'element' => 'h3',
  'weight' => 'normal'
])

<{{ $element }}
  {{ $attributes->class($classes) }}
>
 {{ $slot }}
</{{ $element }}>