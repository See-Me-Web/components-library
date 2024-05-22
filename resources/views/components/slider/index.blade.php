@props([
  'name' => 'slider-name',
  'config' => [],
  'showArrows' => true,
  'showArrowsMobile' => true,
  'showDots' => true,
  'fullWidth' => false,
  'variant' => 'primary'
])

<div 
  ax-load="idle"
  x-data="slider(@Js($name), @Js($config))" 
  @class([
    'swiper mx-auto relative',
    'swiper-full' => $fullWidth,
    $attributes->get('class')
  ])>
  <div @class([
    'swiper-container overflow-hidden w-full h-full',
   ]) x-ref="container">
    <div class="swiper-wrapper">
      {{ $slot ?? '' }}
    </div>
  </div>

  <div class="text-center space-x-2 mt-4 md:mt-8 swiper-arrows" x-show="(isMobile && @Js($showArrowsMobile)) || (! isMobile &&  @Js($showArrows))">
    <x-seeme::button-icon x-on:click="swiper.slidePrev()" icon="chevron-left" variant="{{ $variant }}" />
    <x-seeme::button-icon x-on:click="swiper.slideNext()" icon="chevron-right" variant="{{ $variant }}" />
  </div>

  @if($showDots)
    <div class="flex justify-center mt-5">
      <div x-ref="pagination" class="flex gap-2"></div>
    </div>
  @endif
</div>