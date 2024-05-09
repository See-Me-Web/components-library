@props([
  'inSlider' => false,
])

<div
  id="{{ $block->block->anchor ?? $block->block->id }}"
  style="{{ $style }}"
  data-card-width="{{ $cardWidth }}"
  @class([
    'col-[--card-width]',
    'swiper-slide h-auto' => $inSlider,
    $block->classes,
  ])
>
  @include('seeme::partials.post.tile', ['id' => $id])
</div>