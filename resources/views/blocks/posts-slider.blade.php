@if(isset($slides) && is_array($slides) && !empty($slides))
  <div 
    id="{{ $block->block->anchor ?? $block->block->id }}"
    style="{{ $style }}"
    @class([
      $block->classes,
    ])
  >
    @include('seeme::partials.blockStyles')

    <x-seeme::slider 
      name="slider"
      :showArrows="$sliderConfig['showArrows'] ?? false"
      :showArrowsMobile="$sliderConfig['showArrowsMobile'] ?? false"
      :config="$sliderConfig['config']"
    >
      @foreach($slides as $slide)
        <x-seeme::slider.item>
          @includeFirst([
            'seeme::partials.slider.' . $slide['type'] ?? 'post-layout',
            'seeme::partials.slider.post-layout'
          ], ['slide' => $slide])
        </x-seeme::slider.item>
      @endforeach
    </x-seeme::slider>
  </div>
@endif