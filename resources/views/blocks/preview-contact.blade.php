<div 
  id="{{ $block->block->anchor ?? $block->block->id }}"
  @class([
    'overflow-hidden',
    $block->classes,
  ])
>
  @include('seeme::partials.blockStyles')

  <InnerBlocks 
    allowedBlocks="{{ wp_json_encode($allowedBlocks) }}" 
    @class([
      'flex',
      'flex-wrap',
      'items-stretch'
    ])
    style="{{ $style }}" 
  />
</div>