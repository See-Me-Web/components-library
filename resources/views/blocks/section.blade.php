<section 
  id="{{ $block->block->anchor ?? $block->block->id }}"
  style="{{ $style }}"
>
  <x-seeme::wrap>
    <InnerBlocks />
  </x-seeme::wrap>
</section>