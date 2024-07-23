@props([
  'variant' => 'primary',
  'size' => 'medium',
  'weight' => 'regular',
  'label' => '',
  'styles' => ''
])

<button 
  {{ 
    $attributes->class([
      $classes ?? ''
    ])->merge([
      'style' => $styles
    ])
  }}
>
  {{ $slot ?? $label }}
</button>
