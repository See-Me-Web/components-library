@if(isset($image))
  <div 
    id="{{ $block->block->anchor ?? $block->block->id }}"
    data-width="{{ $width }}"
    @class([
      $block->classes,
    ])
    style="{{ $style ?? '' }}"
  >
    <x-seeme::card variant="{{ $blockVariant ?? 'primary' }}" class="!p-0 h-full">
      <a href="{{ $image->url ?? '' }}" data-fancybox="{{ $parentAnchor }}" data-caption="{{ $image->caption ?? '' }}">
        <x-seeme::image :image="$image" class="object-cover object-center w-full h-full" />
      </a>
    </x-seeme::card>
  </div>
@endif
