<div 
  id="{{ $block->block->anchor ?? $block->block->id }}"
  @class([
    'overflow-hidden',
    $block->classes,
  ])
  ax-load
  x-cloak
  x-data="albumGallery"
  x-on:load.window="isotope.arrange()"
>
  <div class="flex flex-wrap gap-4 justify-between items-center">
    <div>
      <InnerBlocks template="{{ wp_json_encode($template) }}" allowedBlocks="{{ wp_json_encode($allowedBlocks) }}" />
    </div>

    @if( !empty($albums) )
      <div class="flex flex-wrap gap-2 items-center mb-4">
        @foreach($albums as $album)
          <x-seeme::button-link
            href="#{{ $album->slug }}"
            variant="{{ $blockVariant ?? 'primary' }}"
            size="small"
            rounded="lg"
            x-on:click="setAlbum('{{ $album->slug }}')"
            ::class="{
              'is-active': album === '{{ $album->slug }}' || ('{{ $mainAlbumSlug }}' === '{{ $album->slug }}' && album === '')
            }"
          >
            {!! $album->title ?? '' !!}
          </x-seeme::button-link>
        @endforeach
      </div>
    @endif
  </div>
  <div
    @class([
      '-mx-[var(--block-gap,0.5rem)]'
    ])
    x-ref="list"
    style="{{ $style }}"
  >
    @foreach($images as $image)
      <div 
        @class([
          'md:w-[calc(100%_/_var(--columns))]',
          'w-[calc(100%_/_var(--mobile-columns))]',
          'p-[var(--block-gap,0.5rem)] isotope-item',
          $image->album
        ])
      >
        <x-seeme::card 
          variant="{{ $blockVariant ?? 'primary' }}"
          class="!p-0"
        >
          <a 
            href="{{ $image->url ?? '' }}"
            data-fancybox="{{ $block->block->anchor ?? $block->block->id }}"
          >
            <x-seeme::image 
              :image="$image"
              class="object-cover object-center !w-full !h-full"
              x-on:load="isotope.arrange()"
            />
          </a>
        </x-seeme::card>
      </div>
    @endforeach
  </div>
</div>