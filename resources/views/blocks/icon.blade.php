<x-dynamic-component 
  component="seeme::icon.{{ $icon }}" 
  id="{{ $block->block->anchor ?? $block->block->id }}"
  style="{{ $style }}"
  @class([
    'inline-block',
    'align-middle',
    'w-[--icon-size]',
    'h-[--icon-size]',
    $block->classes,
  ]) 
/>
