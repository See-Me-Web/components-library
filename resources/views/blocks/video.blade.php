<div 
  id="{{ $block->block->anchor ?? $block->block->id }}"
  @class([
    $block->classes,
  ])
  style="{{ $style ?? '' }}"
>
  <div @class([
    'max-w-screen-xl mx-auto' => $block->block->align === 'full',
    'max-w-screen-md mx-auto' => $block->block->align === 'center',
    'max-w-screen-md mr-auto ml-0' => $block->block->align === 'left',
    'max-w-screen-md ml-auto mr-0' => $block->block->align === 'right',
  ])>
    <video 
      class="w-full"
      src="{{ $video['url'] ?? '' }}" 
      controls>
    </video>
  </div>
</div>