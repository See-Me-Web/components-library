@props([
  'link' => [
    'url' => '#',
    'label' => '',
    'target' => '_self'
  ]
])

@if($link['url'] !== '#')
  <a 
    href="{{ $link['url'] }}"
    target="{{ $link['target'] }}"
    title="{{ $link['label'] }}"
    {{ $attributes }}
  >
    {!! $slot !!}
  </a>
@else
  {!! $slot !!}
@endif

