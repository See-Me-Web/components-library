@php
  $slideId = uniqid('gallery-');    
@endphp

@if(!empty($slide['images']))
  <x-seeme::card variant="{{ $cardVariant ?? 'primary' }}" class="!p-0 h-full">
    @foreach($slide['images'] as $key => $image)
      <a data-fancybox="{{ $slideId }}" href="{{ $image->url ?? '#' }}">
        <x-seeme::image :image="$image" @class([
          'w-full h-full object-cover object-center',
          'hidden' => $key > 0
        ]) />
      </a>
    @endforeach
  </x-seeme::card>
@endif