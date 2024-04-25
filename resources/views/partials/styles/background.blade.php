@php
  $backgroundVideo = isset($background['backgroundVideo']) ? $background['backgroundVideo'] : [];
  $backgroundSlider = isset($background['backgroundSlider']) ? $background['backgroundSlider'] : [];
  $hasOverlay = $background['hasOverlay'] ?? false;
  $hasVideo = $background['hasVideo'] ?? false;
  $hasSlider = $background['hasSlider'] ?? false;
@endphp


@if($hasOverlay || $hasVideo || $hasSlider)
  <div class="inset-0 absolute -z-10">
    @if($hasVideo)
      @includeFirst([
        'seeme::partials.styles.background.' . ($backgroundVideo['provider'] ?? 'file'), 
        ''
      ])
    @endif

    @if($hasSlider)
      @include('seeme::partials.styles.background.slider')
    @endif

    @if($hasOverlay)
      @include('seeme::partials.styles.background.overlay')
    @endif
  </div>
@endif