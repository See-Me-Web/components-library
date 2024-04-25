@if($map)
  <div 
    id="{{ $block->block->anchor ?? $block->block->id }}"
    @class([
      'h-full',
      $block->classes,
    ])
  >
    <x-seeme::map :markers="$map['markers'] ?? []" :marker-icon="$markerIcon" class="min-h-[300px] h-full"/>
  </div>
@endif
