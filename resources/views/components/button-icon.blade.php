@props([
  'icon' => ''
  'size' => 'medium'
])

<a 
  {{ 
    $attributes->class([
      $classes ?? ''
    ])->merge([
      'style' => $styles
    ])
  }}
>
  <x-dynamic-component component="seeme::icon.{{ $icon }}" />
</a>