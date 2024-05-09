@if(isset($posts) && is_array($posts) && !empty($posts))
  <div 
    id="{{ $block->block->anchor ?? $block->block->id }}"
    style="{{ $style }}"
    @class([
      $block->classes,
    ])
  >
    @include('seeme::partials.blockStyles')

    <x-seeme::slider 
      name="posts-slider"
      :showArrows="$sliderConfig['showArrows'] ?? false"
      :showArrowsMobile="$sliderConfig['showArrowsMobile'] ?? false"
      :config="$sliderConfig['config']"
    >
      @foreach($posts as $postId)
        <x-seeme::slider.item>
          @include('seeme::partials.post.tile', ['id' => $postId])
        </x-seeme::slider.item>
      @endforeach
    </x-seeme::slider>
  </div>
@endif