@props([
  'variant' => 'primary',
  'size' => 'medium',
  'weight' => 'regular',
  'label' => '',
  'styles' => ''
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
  {{ $slot ?? $label }}
</a>