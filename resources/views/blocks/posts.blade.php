<div 
  id="{{ $block->block->anchor ?? $block->block->id }}"
  @class([
    $block->classes,
  ])
>
  @include('seeme::partials.blockStyles')

  <div 
    @class([
      'grid',
      'grid-flow-row-dense',
      'grid-cols-[--mobile-columns]' => $mobileVertical,
      'md:grid-cols-[--columns]' => $mobileVertical,
      'grid-cols-[--columns]' => ! $mobileVertical,
      'gap-2'
    ]) 
    style="{{ $style }}"
  >
    @foreach($posts as $postId)
      @include('seeme::partials.post.tile', ['id' => $postId])
    @endforeach
  </div>
</div>