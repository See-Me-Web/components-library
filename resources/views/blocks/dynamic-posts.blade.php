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
      <div class="flex flex-wrap gap-2 items-center">
        <x-seeme::button-link
          href="#all"
          x-on:click="setCategory(0)"
          variant="primary"
          size="small"
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
            variant="primary"
            size="small"
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
    @foreach($posts as $post)
      <div class="initial dynamic-posts__item dynamic-posts__item--initial">
        @include('seeme::partials.post.tile', ['id' => $post->ID])
      </div>
    @endforeach

    <template x-for="post in posts">
      <div class="appended dynamic-posts__item dynamic-posts__item--appended">
        @include('seeme::partials.post.tile-template')
      </div>
    </template>
  </div>
  
  <div class="text-center mt-8" x-show="loading || page < settings.maxPages" x-transition>
    <x-seeme::button x-on:click="fetchNextPage()">
      {{ __('ZOBACZ WIĘCEJ', 'sm-components') }}
      <x-seeme::loader x-show="loading" style="display: none" />
    </x-seeme::button>
  </div>
</div>