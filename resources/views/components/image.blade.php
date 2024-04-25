@props([
  'image' => (object) [
    'url' => '',
    'width' => '',
    'height' => '',
    'alt' => ''
  ],
  'loading' => 'lazy'
])

<img 
  src="{{ $image->url }}" 
  width="{{ $image->width }}" 
  height="{{ $image->height }}" 
  alt="{{ $image->alt }}" 
  loading="{{ $loading }}"
  {{ $attributes }} 
/>