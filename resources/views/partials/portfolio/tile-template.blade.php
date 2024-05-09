<div class="p-4" x-bind:class="post.classes" x-bind:style="post.styles">
  <a x-bind:href="post.permalink" x-bind:title="post.title">
    <img 
      x-bind:src="post.thumbnail.url"
      x-bind:width="post.thumbnail.width"
      x-bind:height="post.thumbnail.height"
      x-bind:alt="post.thumbnail.alt"
      loading="lazy"
      class="mb-4 max-w-full w-full h-full max-h-[15rem] object-cover object-center" 
    />
  </a>

  <a x-bind:href="post.permalink" x-bind:title="post.title">
    <h3 class="text-current text-lg mb-4 font-bold" x-html="post.title"></h3>
  </a>

  <div class="text-current line-clamp-4" x-html="post.excerpt"></div>
</div>
