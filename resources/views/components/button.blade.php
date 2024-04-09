@props([
  'style' => 'primary',
  'size' => 'medium',
  'label' => '',

])

<button 
  {{ $attributes->class([
    $buttonClasses ?? ''
  ])}}>
  {{ $slot ?? $label }}
</button>