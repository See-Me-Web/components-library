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
        <li>
          <a href="{{ $social['url'] ?? '#' }}" target="_blank" rel="nofollow">
            <x-dynamic-component 
              component="seeme::icon.socials.{{ $social['type'] }}" 
              @class([
                'w-[--socials-size]',
                'h-[--socials-size]',
              ]) 
            />
          </a>
        </li>
      @endforeach
    </ul>
  @endif
</section>