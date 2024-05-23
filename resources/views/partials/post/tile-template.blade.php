<template x-if="post.type === 'post'">
  @include('seeme::partials.article.tile-template')
</template>

<template x-if="post.type === 'portfolio'">
  @include('seeme::partials.portfolio.tile-template')
</template>