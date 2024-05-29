<div 
  id="{{ $block->block->anchor ?? $block->block->id }}"
  @class([
    $block->classes,
  ])
>
  @include('seeme::partials.blockStyles')

  <div class="flex flex-wrap gap-4 justify-between items-center">
    <div>
      <InnerBlocks allowedBlocks="{{ wp_json_encode($allowedBlocks) }}" />
    </div>

    @if(!empty($categories))
      <div class="flex flex-wrap gap-2 items-center mb-4">
        <x-seeme::button-link
          href="#all"
          variant="{{ $blockVariant ?? 'primary' }}"
          size="small"
          rounded="lg"
          class="is-active"
        >
          {{ __('All', 'sm-components') }}
        </x-seeme::button-link>

        @foreach($categories as $category)
          <x-seeme::button-link
            href="#{{ $category->slug ?? '' }}"
            variant="{{ $blockVariant ?? 'primary' }}"
            size="small"
            rounded="lg"
          >
            {{ $category->name ?? '' }}
          </x-seeme::button-link>
        @endforeach
      </div>
    @endif
  </div>

  <div
    @class([
      'relative',
      'grid',
      'gap-2',
      'grid-cols-[--mobile-columns]' => $mobileVertical,
      'md:grid-cols-[--columns]' => $mobileVertical,
      'grid-cols-[--columns]' => ! $mobileVertical 
    ])
    style="{{ $style }}"
  >
    @foreach($posts as $key => $post)
      <div 
        class="initial dynamic-posts__item dynamic-posts__item--initial" 
      >
        @include('seeme::partials.post.tile', ['id' => $post->ID])
      </div>
    @endforeach
  </div>
  
  <div class="text-center mt-8">
    <x-seeme::button variant="{{ $blockVariant ?? 'primary' }}">
      {{ __('MORE', 'sm-components') }}
    </x-seeme::button>
  </div>
</div>