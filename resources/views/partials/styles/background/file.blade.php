@php
    $backgroundVideo = isset($background['backgroundVideo']) ? $background['backgroundVideo'] : [];
    $video = $backgroundVideo['video'] ?? [];
@endphp

<video 
  src="{{ $video['url'] ?? '' }}" 
  class="w-full h-full object-cover aspect-video" 
  autoplay
  muted
  loop
></video>