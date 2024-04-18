@php
  $backgroundVideo = isset($background['backgroundVideo']) ? $background['backgroundVideo'] : [];
  $backgroundSlider = isset($background['backgroundSlider']) ? $background['backgroundSlider'] : [];
@endphp

<div class="inset-0 absolute -z-10">
  @if(isset($background['hasVideo']) && $background['hasVideo'] == true)
    @includeFirst([
      'seeme::partials.styles.background.' . ($backgroundVideo['provider'] ?? 'file'), 
      ''
    ])
  @endif

  @if(isset($background['hasSlider']) && $background['hasSlider'] == true)
    @include('seeme::partials.styles.background.slider')
  @endif

  @if(isset($background['hasOverlay']) && $background['hasOverlay'] == true)
    @include('seeme::partials.styles.background.overlay')
  @endif
</div>