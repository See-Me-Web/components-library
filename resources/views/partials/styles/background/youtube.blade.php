@php
    $backgroundVideo = isset($background['backgroundVideo']) ? $background['backgroundVideo'] : [];
    $id = $backgroundVideo['youtubeId'] ?? [];
@endphp

<iframe 
  src="https://www.youtube.com/embed/{{ $id }}?autoplay=1&controls=0&rel=0&mute=1" 
  allow="autoplay" 
  class="aspect-video min-h-[150%] min-w-full object-cover absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2"
></iframe>