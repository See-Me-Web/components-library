<section 
  id="{{ $block->block->anchor ?? $block->block->id }}"
  style="{{ $style }}"
  @class([
    $block->classes,
  ])
>
  @include('seeme::partials.blockStyles')
  
  <InnerBlocks template="{{ wp_json_encode($template) }}" />
</section>