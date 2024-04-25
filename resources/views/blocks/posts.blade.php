<div 
  id="{{ $block->block->anchor ?? $block->block->id }}"
  @class([
    $block->classes,
  ])
>
  @include('seeme::partials.blockStyles')

  <div 
    @class([
      'grid',
      'grid-cols-[--mobile-columns]' => $mobileVertical,
      'md:grid-cols-[--columns]' => $mobileVertical,
      'grid-cols-[--columns]' => ! $mobileVertical 
    ]) 
    style="{{ $style }}"
  >
    <InnerBlocks allowedBlocks="{{ wp_json_encode($allowedBlocks) }}" />
  </div>
</div>