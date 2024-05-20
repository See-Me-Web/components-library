<x-dynamic-component 
  component="seeme::icon.{{ $icon }}" 
  id="{{ $block->block->anchor ?? $block->block->id }}"
  style="{{ $style }}"
  @class([
    'inline-block',
    'align-middle',
    'size-[--icon-size]',
    $block->classes,
  ]) 
/>