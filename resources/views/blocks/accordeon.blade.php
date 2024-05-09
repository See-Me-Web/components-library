<div 
  id="{{ $block->block->anchor ?? $block->block->id }}"
  style="{{ $style }}"
  @class([
    $block->classes,
  ])
>
  <div
    x-data="{
      open: @Js($open ?? false)
    }"
  >
    <div class="flex gap-2 cursor-pointer items-center" x-on:click="open = ! open">
      <h3>{{ $title }}</h3>
      <span>
        <x-seeme::icon.chevron-right class="w-4 h-4" x-show="! open" />
        <x-seeme::icon.chevron-up class="w-4 h-4" x-show="open" />
      </span>
    </div>

    <div 
      x-show="open" 
      x-collapse 
      @class([
        'before:content-empty before:block before:h-1',
        'after:content-empty after:block after:h-3',
      ])>
      <InnerBlocks allowedBlocks="{{ wp_json_encode($allowedBlocks) }}" />
    </div>
  </div>
</div>