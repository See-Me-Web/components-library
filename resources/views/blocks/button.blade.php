@if(isset($link) && is_array($link) && !empty($link))
  <x-seeme::button-link
    :href="$link['url'] ?? '#'"
    :target="$link['target'] ?? '_self'"
    :variant="$variant ?? 'primary'"
    :size="$size ?? 'medium'"
    :styles="$style"
    :class="$block->classes"
  >
    @if( $iconLeft )
      <x-slot name="iconLeft">
        @svg($iconLeft, 'w-5 h-5')
      </x-slot>
    @endif

    {!! $link['title'] ?? '' !!}

    @if( $iconRight )
      <x-slot name="iconRight">
        @svg($iconRight, 'w-5 h-5')
      </x-slot>
    @endif
  </x-seeme::button-link>
@endif