@if($map)
  <div 
    id="{{ $block->block->anchor ?? $block->block->id }}"
    @class([
      'h-full',
      $block->classes,
    ])
  >
    <img src="{{ asset('/images/map-placeholder.png') }}" class="max-w-full !h-full object-cover" />
  </div>
@endif
