@php
    $backgroundVideo = isset($background['backgroundVideo']) ? $background['backgroundVideo'] : [];
    $video = $backgroundVideo['video'] ?? [];
    $mobileVideo = $backgroundVideo['mobileVideo'] ?? [];
@endphp


@if( !empty($video) )
  <video 
    src="{{ $video['url'] ?? '' }}" 
    @class([
      'w-full h-full object-cover aspect-video',
      'hidden lg:block' => !empty($mobileVideo)
    ])
    autoplay
    muted
    loop
  ></video>
@endif

@if( !empty($mobileVideo) ) 
  <video 
    src="{{ $mobileVideo['url'] ?? '' }}" 
    @class([
      'w-full h-full object-cover aspect-video',
      'block lg:hidden'
    ])
    autoplay
    muted
    loop
  ></video>
@endif