@props([
  'style' => 'primary',
  'size' => 'medium',
  'label' => '',

])

<button 
  class="button">
  {{ $slot ?? $label }}
</button>