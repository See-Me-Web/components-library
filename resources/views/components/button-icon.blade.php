@props([
  'variant' => 'primary',
  'size' => 'medium',
  'weight' => 'regular',
  'styles' => '',
  'icon' => '',
])

<a 
  {{ 
    $attributes->class([
      'cursor-pointer',
      $classes ?? ''
    ])->merge([
      'style' => $styles
    ])
  }}
>
  <x-dynamic-component component="seeme::icon.{{ $icon }}" />
</a>