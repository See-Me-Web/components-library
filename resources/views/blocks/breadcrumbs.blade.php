@if(isset($items) && is_array($items) && !empty($items))
  @php 
    $count = count($items);
    $current = 1;
  @endphp

  <div 
    id="{{ $block->block->anchor ?? $block->block->id }}"
    @class([
      $block->classes,
    ])
    style="{{ $style ?? '' }}"
  >
    <ul class="list-none flex items-center gap-x-2 flex-wrap">
      @foreach($items as $key => $item)
        <li>
          @if(isset($item['url']) && !empty($item['url']))
            <a href="{{ $item['url'] ?? '' }}" class="!no-underline hover:underline">
              {!! $item['title'] ?? '' !!}
            </a>
          @else
            <span>
              {!! $item['title'] ?? '' !!}
            </span>
          @endif
        </li>

        @if($current !== $count)
          <li class="">
            <x-seeme::icon.chevron-right class="size-3" />
          </li>
        @endif

        @php $current += 1 @endphp
      @endforeach
    </ul>
  </div>
@endif