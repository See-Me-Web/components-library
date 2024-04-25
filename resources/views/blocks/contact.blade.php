<div 
  id="{{ $block->block->anchor ?? $block->block->id }}"
  @class([
    'overflow-hidden',
    $block->classes,
  ])
>
  @include('seeme::partials.blockStyles')

  <div 
    @class([
      'flex',
      'flex-wrap',
      'flex-col lg:flex-row'
    ])
    style="{{ $style }}"
  >
    <InnerBlocks allowedBlocks="{{ wp_json_encode($allowedBlocks) }}" />
  </div>
</div>