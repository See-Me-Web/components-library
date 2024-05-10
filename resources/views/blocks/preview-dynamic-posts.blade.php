<div 
  id="{{ $block->block->anchor ?? $block->block->id }}"
  @class([
    $block->classes,
  ])
>
  @include('seeme::partials.blockStyles')

  <div class="flex flex-wrap gap-4 justify-between">
    <div>
      <InnerBlocks allowedBlocks="{{ wp_json_encode($allowedBlocks) }}" />
    </div>

    @if(!empty($categories))
      <div class="flex flex-wrap gap-2">
        <x-seeme::button-link
          href="#all"
          variant="primary"
          size="small"
        >
          {{ __('All', 'sm-components') }}
        </x-seeme::button-link>

        @foreach($categories as $category)
          <x-seeme::button-link
            href="#{{ $category->slug ?? '' }}"
            variant="primary"
            size="small"
          >
            {{ $category->name ?? '' }}
          </x-seeme::button-link>
        @endforeach
      </div>
    @endif
  </div>

  <div
    @class([
      'grid',
      'grid-cols-[--mobile-columns]' => $mobileVertical,
      'md:grid-cols-[--columns]' => $mobileVertical,
      'grid-cols-[--columns]' => ! $mobileVertical 
    ])
    style="{{ $style }}"
  >
    @foreach($posts as $post)
      <div class="initial dynamic-posts__item dynamic-posts__item--initial">
        @include('seeme::partials.post.tile', ['id' => $post->ID])
      </div>
    @endforeach
  </div>
  
  <div class="text-center mt-8">
    <x-seeme::button>
      {{ __('ZOBACZ WIĘCEJ', 'sm-components') }}
    </x-seeme::button>
  </div>
</div>