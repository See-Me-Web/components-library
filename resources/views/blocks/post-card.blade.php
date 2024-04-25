<div
  id="{{ $block->block->anchor ?? $block->block->id }}"
  style="{{ $style }}"
  data-card-width="{{ $cardWidth }}"
  @class([
    'col-[--card-width]',
    $block->classes,
  ])
>
  @includeFirst([
    'seeme::partials.' . $postType . '.tile', 
    'seeme::partials.post.tile'
  ], [
    'id' => $id
  ])
</div>