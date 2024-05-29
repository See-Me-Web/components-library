<x-seeme::accordeon
  :title="$title"
  :openByDefault="$open"
  :simple="$simple"
  id="{{ $block->block->anchor ?? $block->block->id }}"
  @class([
    $block->classes,
  ])
  style="{{ $style ?? '' }}"
>
  <InnerBlocks allowedBlocks="{{ wp_json_encode($allowedBlocks) }}" />
</x-seeme::accordeon>