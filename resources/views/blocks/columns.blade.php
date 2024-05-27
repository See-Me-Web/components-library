<div 
  id="{{ $block->block->anchor ?? $block->block->id }}"
  @class([
    'grid',
    'grid-cols-[--mobile-columns]' => $mobileVertical,
    'md:grid-cols-[--columns]' => $mobileVertical,
    'grid-cols-[--columns]' => ! $mobileVertical,
    $block->classes
  ])
  style="{{ $style ?? '' }}"
>
  <InnerBlocks template="{{ wp_json_encode($template) }}" allowedBlocks="{{ wp_json_encode($allowedBlocks) }}" />
</div>