<div 
  id="{{ $block->block->anchor ?? $block->block->id }}"
  @class([
    'overflow-hidden',
    $block->classes,
  ])
  ax-load
  x-data="albumGallery({}, @Js($paged), @Js($perPage))"
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
    @foreach($images as $index => $image)
      <div 
        @class([
          'md:w-[calc(100%_/_var(--columns))]',
          'w-[calc(100%_/_var(--mobile-columns))]',
          'p-[var(--block-gap,0.5rem)] isotope-item',
          $image->album,
        ])
      >
        <x-seeme::card 
          variant="{{ $blockVariant ?? 'primary' }}"
          class="!p-0"
        >
          <a 
            href="{{ $image->url ?? '' }}"
            data-fancybox="{{ $block->block->anchor ?? $block->block->id }}"
            class="relative block"
          >
            <x-seeme::image 
              :image="$image"
              class="object-cover object-center !w-full !h-full"
            />

            @if( isset($displayCaption) && $displayCaption && ! empty($image->caption) )
              <div @class([
                'absolute inset-0 flex items-end',
              ])>
                <div @class([
                  'p-2 font-semibold text-center w-full leading-none text-sm lg:text-base lg:leading-normal bg-base-white/90 relative',
                  'before:block before:absolute before:top-0 before:-translate-y-full before:left-0',
                  'before:w-full before:h-8 before:bg-gradient-to-t before:from-base-white/90 before:to-transparent'
                ])>
                  {!! $image->caption !!}
                </div>
              </div>
            @endif
          </a>
        </x-seeme::card>
      </div>
    @endforeach
  </div>
  <div class="text-center mt-8" x-transition>
    <x-seeme::button 
      x-show="hasNextPage"
      variant="{{ $blockVariant ?? 'primary' }}" 
      x-on:click="loadNextPage()" 
      size="small"
    >
      {{ __('MORE', 'sm-components') }}
    </x-seeme::button>
  </div>
</div>