<div 
  id="{{ $block->block->anchor ?? $block->block->id }}"
  @class([
    'text-[length:--font-size] leading-none whitespace-nowrap pointer-events-none',
    $block->classes,
  ])
  style="{{ $style }}"
> 
  <div 
    x-data="{ 
      transform: 0, 
      calculateTransform() {
        this.transform = window.pageYOffset * @Js($speedFactor)
      } 
    }"
    x-init="calculateTransform"
    x-on:scroll.window="calculateTransform"
    :style="`transform: translateX(-${transform}px)`"
  >
    {{ $text }}
  </div>
</div>