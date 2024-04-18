@php
    $backgroundSlider = isset($background['backgroundSlider']) ? $background['backgroundSlider'] : [];
    $slides = $backgroundSlider['slides'] ?? [];
@endphp

@if(!empty($slides))
  <x-seeme::slider 
    class="h-full"
    name="background-slider"
    :fullWidth="true"
    :showArrows="$backgroundSlider['showArrows'] ?? false"
    :showArrowsMobile="$backgroundSlider['showArrows'] ?? false"
    :config="$backgroundSlider['config'] ?? []"
  > 
    @foreach($slides as $slide)
      <x-seeme::slider.item>
        <img src="{{ $slide['sizes']['large'] }}" class="object-cover object-center w-full h-full" />
      </x-seeme::slider.item>
    @endforeach
  </x-seeme::slider>
@endif