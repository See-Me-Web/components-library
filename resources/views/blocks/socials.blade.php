<section 
  id="{{ $block->block->anchor ?? $block->block->id }}"
  @class([
    'overflow-hidden',
    $block->classes,
])
>
  @include('seeme::partials.blockStyles')
  
  @if(isset($socials) && is_array($socials) && !empty($socials))
    <ul class="flex flex-wrap gap-2" style="{{ $style }}">
      @foreach($socials as $social)
        @if( isset($social['type']) && $social['type'] )
          <li>
            <a 
              href="{{ $social['url'] ?? '#' }}" 
              target="_blank" 
              rel="nofollow"
              title="{{ $social['type'] }}"
            >
              <x-dynamic-component 
                component="seeme::icon.socials.{{ $social['type'] }}" 
                @class([
                  'size-[--socials-size]',
                ]) 
              />
              <span class="sr-only">{{ $social['type'] }}</span>
            </a>
          </li>
        @endif
      @endforeach
    </ul>
  @endif
</section>