<x-seeme::preview-accordeon
  :title="$title"
  :openByDefault="$open"
  id="{{ $block->block->anchor ?? $block->block->id }}"
  @class([
    $block->classes,
  ])
  style="{{ $style ?? '' }}"
>
  <InnerBlocks allowedBlocks="{{ wp_json_encode($allowedBlocks) }}" />
</x-seeme::preview-accordeon>