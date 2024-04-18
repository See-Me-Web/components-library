<div 
  class="text-[17vw] leading-none whitespace-nowrap"
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