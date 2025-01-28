<div 
  id="{{ $block->block->anchor ?? $block->block->id }}"
  @class([
    $block->classes,
  ])
  style="{{ $style ?? '' }}"
>
  <div class="max-w-screen-xl mx-auto">
    <video 
      class="w-full"
      src="{{ $video['url'] ?? '' }}" 
      controls>
    </video>
  </div>
</div>