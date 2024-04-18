<div @class([
  'swiper-slide h-auto',
  $attributes->get('class')
]) {{ $attributes }}>
  {{ $slot ?? '' }}
</div>