<div 
  id="{{ $block->block->anchor ?? $block->block->id }}"
  @class([
    $block->classes,
  ])
>
  <div class="flex flex-wrap gap-4 justify-between items-center">
    <div>
      <InnerBlocks template="{{ wp_json_encode($template) }}" allowedBlocks="{{ wp_json_encode($allowedBlocks) }}" />
    </div>

    @if( !empty($albums) )
      <div class="flex flex-wrap gap-2 items-center mb-4">
        @foreach($albums as $key => $album)
          <x-seeme::button-link
            href="#{{ $album->slug }}"
            variant="{{ $blockVariant ?? 'primary' }}"
            size="small"
            rounded="lg"
            @class([
              'is-active' => $key === 0
            ])
          >
            {{ $album->title ?? '' }}
          </x-seeme::button-link>
        @endforeach
      </div>
    @endif
  </div>
  <div
    @class([
      '-mx-[--block-gap]',
      'flex flex-wrap',
      '!gap-0'
    ])
    style="{{ $style }}"
  >
    @foreach($images as $image)
      <div 
        @class([
          'md:max-w-[calc(100%_/_var(--columns))]',
          'max-w-[calc(100%_/_var(--mobile-columns))]',
          'p-[var(--block-gap,0.5rem)] shuffle-item'
        ])
        data-groups="{{ wp_json_encode($image->album ?? []) }}"
      >
        <x-seeme::card 
          variant="{{ $blockVariant ?? 'primary' }}"
          class="!p-0 aspect-video"
        >
          <a 
            href="{{ $image->url ?? '' }}"
            data-fancybox="{{ $block->block->anchor ?? $block->block->id }}"
          >
            <x-seeme::image 
              :image="$image"
              class="object-cover object-center !w-full !h-full" 
            />
          </a>
        </x-seeme::card>
      </div>
    @endforeach
  </div>
</div>