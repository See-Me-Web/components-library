<div class="flex flex-col gap-4 h-full">
  <x-seeme::card variant="{{ $cardVariant ?? 'primary' }}" class="flex-1 !p-0">
    <a 
      href="{{ $slide['permalink'] ?? '#' }}"
      title="{!! $slide['title'] ?? '' !!}"
      class="font-bold hover:no-underline no-underline"
    >
      <x-seeme::image :image="$slide['thumbnail'] ?? []" class="w-full h-full object-cover object-center" />
    </a>
  </x-seeme::card>

  <x-seeme::card 
    variant="{{ $cardVariant ?? 'primary' }}" 
    class="text-center"
  >
    <a 
      href="{{ $slide['permalink'] ?? '#' }}"
      title="{!! $slide['title'] ?? '' !!}"
      class="font-bold hover:no-underline no-underline"
    >
      {!! $slide['title'] ?? '' !!}
    </a>
  </x-seeme::card>
</div>
