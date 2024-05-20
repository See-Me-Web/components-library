<x-seeme::card variant="{{ $cardVariant ?? 'primary' }}" class="!p-0 h-full">
  <a href="{{ $slide['image']->url ?? '' }}" data-fancybox>
    <x-seeme::image :image="$slide['image']" class="object-cover object-center w-full h-full" />
  </a>
</x-seeme::card>