<div 
  id="{{ $block->block->anchor ?? $block->block->id }}"
  style="{{ $style }}"
  @class([
    $block->classes,
  ])
>
  <div>
    <div class="flex gap-2 cursor-pointer items-center">
      <h3>{{ $title }}</h3>
      <span>
        <x-seeme::icon.chevron-up class="w-4 h-4" />
      </span>
    </div>

    <div class="before:content-empty before:block before:h-2">
      <InnerBlocks allowedBlocks="{{ wp_json_encode($allowedBlocks) }}" />
    </div>
  </div>
</div>