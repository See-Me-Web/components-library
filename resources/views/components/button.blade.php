@props([
  'variant' => 'primary',
  'size' => 'medium',
  'label' => '',
  'iconLeft' => '',
  'iconRight' => '',
  'cssStyles' => ''
])

<button 
  {{ 
    $attributes->class([
      $classes ?? ''
    ])->merge([
      'style' => $cssStyles
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