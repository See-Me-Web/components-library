<x-seeme::card variant="{{ $blockVariant ?? '' }}" x-bind:data-card-width="post.cardWidth">
  <template x-if="post.thumbnail">
    <a 
      x-bind:href="post.permalink" 
      x-bind:title="post.title"
    >
      <img 
        x-bind:src="post.thumbnail.url"
        x-bind:width="post.thumbnail.width"
        x-bind:height="post.thumbnail.height"
        x-bind:alt="post.thumbnail.alt"
        loading="lazy"
        :class="{
          'mb-4 max-w-full w-full h-auto max-h-[15rem]',
          'object-cover object-center' : post.hasThumbnail
        }"
      />
    </a>
  </template>

  <div class="uppercase" x-html="post.listedCategories"></div>

  <a 
    x-bind:href="post.permalink" 
    x-bind:title="post.title"
    class="hover:no-underline"
  >
    <h3 class="text-current text-base mb-4 font-bold" x-html="post.title"></h3>
  </a>

  <div class="text-current line-clamp-4" x-html="post.excerpt"></div>
</x-seeme::card>
