<section 
  id="{{ $block->block->anchor ?? $block->block->id }}"
  style="{{ $style }}"
  class="{{ $classes }}"
>
  <x-seeme::wrap>
    <InnerBlocks />
  </x-seeme::wrap>
</section>