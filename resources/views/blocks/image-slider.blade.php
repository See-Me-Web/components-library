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
      name="image-slider"
      :showArrows="$sliderConfig['showArrows'] ?? false"
      :showArrowsMobile="$sliderConfig['showArrowsMobile'] ?? false"
      :config="$sliderConfig['config']"
    >
      @foreach($slides as $slide)
        <x-seeme::slider.item>
          <x-seeme::link :link="$slide['link'] ?? []">
            <x-seeme::image :image="$slide['image'] ?? []" loading="lazy" />
            <span class="sr-only">{{ $slide['link']['label'] ?? '' }}</span>
          </x-seeme::link>
        </x-seeme::slider.item>
      @endforeach
    </x-seeme::slider>
  </div>
@endif