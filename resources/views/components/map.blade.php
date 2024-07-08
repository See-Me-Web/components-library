@props([
  'markers' => [],
  'markerIcon' => false
])

<div 
  ax-load="idle"
  x-data="map"
  @class([
    'relative h-full w-full z-0',
    $attributes->get('class')
  ])
>
  @foreach($markers as $marker)
    <div
      data-marker
      class="" 
      data-address="{{ $marker['label'] ?? '' }}" 
      data-lng="{{ $marker['lng'] ?? '' }}" 
      data-lat="{{ $marker['lat'] ?? '' }}"
      data-icon="{{ $markerIcon ? $markerIcon : asset('/images/marker-icon.png') }}"
      data-icon-height="40"
    ></div>
  @endforeach

  <div 
    class="flex items-center justify-center text-white text-center inset-0 absolute bg-system-black-main text-base md:text-xl z-[1000] pointer-events-none opacity-0 transition-all"
    :class="{'opacity-100': showMask && ! isMobile}">
    {{ __('Press CTRL and scroll to zoom', 'sm-component') }}
  </div>

  <div 
    class="flex items-center justify-center text-white text-center inset-0 absolute bg-system-black-main text-base md:text-xl z-[1000] pointer-events-none opacity-0 transition-all"
    :class="{'opacity-100': showMask && isMobile}">
    {{ __('Use two fingers to move the map', 'sm-components') }}
  </div>
</div>