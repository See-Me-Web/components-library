@props([
  'name' => 'slider-name',
  'config' => [],
  'showArrows' => true,
  'showArrowsMobile' => true,
  'showDots' => true,
  'fullWidth' => false
])

<div 
  ax-load="idle"
  x-data="slider(@Js($name), @Js($config))" 
  x-on:resize.window.debounce="showNav = !(swiper.isBeginning && swiper.isEnd)"
  @class([
    'flex',
    'swiper mx-auto relative',
    'swiper-full' => $fullWidth,
    'xl:px-7' => $showArrows && ! $fullWidth,
    'px-5' => $showArrows && $showArrowsMobile && ! $fullWidth,
    $attributes->get('class')
  ])>
  <div @class([
    'swiper-container overflow-hidden w-full h-full',
   ]) x-ref="container">
    <div class="swiper-wrapper">
      {{ $slot ?? '' }}
    </div>
  </div>

  <div class="swiper-arrows" x-show="showNav && ((isMobile && @Js($showArrowsMobile)) || (! isMobile &&  @Js($showArrows)))">
    <div 
      x-show="! isBeginning" 
      @class([
        'cursor-pointer absolute top-1/2 -translate-y-1/2 z-10',
        'left-0' => ! $fullWidth,
        'left-4' => $fullWidth
      ])
      x-on:click="swiper.slidePrev()"
    >
      <x-seeme::icon.chevron-left class="text-green"/>
    </div>

    <div 
      x-show="! isEnd" 
      @class([
        'cursor-pointer absolute top-1/2 -translate-y-1/2 z-10',
        'right-0' => ! $fullWidth,
        'right-4' => $fullWidth
      ])
      x-on:click="swiper.slideNext()"
    >
      <x-seeme::icon.chevron-right class="text-green"/>
    </div>
  </div>

  @if($showDots)
    <div class="flex justify-center mt-5">
      <div x-ref="pagination" class="flex gap-2"></div>
    </div>
  @endif
</div>