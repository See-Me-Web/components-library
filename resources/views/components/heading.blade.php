@props([
  'size' => 'md',
  'headingSize' => 'h3',
  'weight' => 'normal'
])

<{{ $headingSize }}
  {{ $attributes->class($classes) }}
>
 {{ $slot }}
</{{ $headingSize }}>