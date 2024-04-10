<div 
  id="{{ $block->block->anchor ?? $block->block->id }}"
  @class([
    'flex flex-wrap gap-4',
    str_replace(
      [
        'align-text-left',
        'align-text-center',
        'align-text-right',
      ], 
      [
        'justify-start',
        'justify-center',
        'justify-end',
      ],
      $block->classes
    )
  ])
  style="{{ $style ?? '' }}"
>
  <InnerBlocks allowedBlocks="{{ wp_json_encode($allowedBlocks) }}" />
</div>