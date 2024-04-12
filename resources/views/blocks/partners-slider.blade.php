<section 
  id="{{ $block->block->anchor ?? $block->block->id }}"
  style="{{ $style }}"
>
  <x-seeme::wrap>
      <InnerBlocks allowedBlocks="{{ wp_json_encode($allowedBlocksBefore) }}" />

      <InnerBlocks allowedBlocks="{{ wp_json_encode($allowedBlocksInner) }}" />

      <InnerBlocks allowedBlocks="{{ wp_json_encode($allowedBlocksAfter) }}" />
  </x-seeme::wrap>
</section>