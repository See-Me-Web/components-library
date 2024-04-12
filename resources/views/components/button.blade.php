@props([
  'variant' => 'primary',
  'size' => 'medium',
  'label' => '',
  'iconLeft' => '',
  'iconRight' => '',
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
  @if( $iconLeft )
    {{ $iconLeft }}
  @endif

  {{ $slot ?? $label }}

  @if( $iconRight )
    {{ $iconRight }}
  @endif
</button>