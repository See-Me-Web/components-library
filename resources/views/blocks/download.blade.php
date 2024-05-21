@if(isset($file))
  <div 
    id="{{ $block->block->anchor ?? $block->block->id }}"
    @class([
      $block->classes,
    ])
    style="{{ $style ?? '' }}"
  >
    <a href="{{ $file['url'] ?? '#' }}" download title="{{ $file['title'] ?? '' }}">
      {{ $file['title'] ?? '' }} 
      / <x-seeme::icon.download class="inline-block size-4 align-text-top" /> {{ __('download', 'sm-components') }} /
    </a>
  </div>
@endif