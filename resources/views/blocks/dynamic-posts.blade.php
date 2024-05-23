<div 
  id="{{ $block->block->anchor ?? $block->block->id }}"
  @class([
    $block->classes,
  ])
  ax-load
  x-data="dynamicPosts(@Js($action), @Js($nonce), @Js($settings))"
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
          x-on:click="setCategory(0)"
          variant="{{ $blockVariant ?? 'primary' }}"
          size="small"
          rounded="lg"
          ::class="{
            'is-active' : category === 0
          }"
        >
          {{ __('All', 'sm-components') }}
        </x-seeme::button-link>

        @foreach($categories as $category)
          <x-seeme::button-link
            href="#{{ $category->slug ?? '' }}"
            x-on:click="setCategory({{ $category->term_id ?? 0 }})"
            variant="{{ $blockVariant ?? 'primary' }}"
            size="small"
            rounded="lg"
            ::class="{
              'is-active': category === {{ $category->term_id ?? 0 }}
            }"
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
      'grid-flow-row-dense',
      'grid-cols-[--mobile-columns]' => $mobileVertical,
      'md:grid-cols-[--columns]' => $mobileVertical,
      'grid-cols-[--columns]' => ! $mobileVertical 
    ])
    x-ref="list"
    :class="{
      'loading': loading
    }"
    style="{{ $style }}"
  >
    @foreach($posts as $key => $post)
      <div 
        class="initial dynamic-posts__item dynamic-posts__item--initial"
      >
        @include('seeme::partials.post.tile', ['id' => $post->ID])
      </div>
    @endforeach

    <template x-for="(post, index) in posts">
      <div 
        class="appended dynamic-posts__item dynamic-posts__item--appended" 
      >
        @include('seeme::partials.post.tile-template')
      </div>
    </template>
  </div>
  
  <div class="text-center mt-8" x-show="loading || page < settings.maxPages" x-transition>
    <x-seeme::button variant="{{ $blockVariant ?? 'primary' }}" x-on:click="fetchNextPage()">
      <span x-show="! loading">{{ __('ZOBACZ WIĘCEJ', 'sm-components') }}</span>
      <x-seeme::loader x-show="loading" style="display: none" />
    </x-seeme::button>
  </div>
</div>