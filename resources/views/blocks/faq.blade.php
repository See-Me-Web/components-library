@if(isset($groups) && is_array($groups) && !empty($groups))
  <div
    id="{{ $block->block->anchor ?? $block->block->id }}"
    @class([
      $block->classes,
    ])
    x-data="{
      active: @Js($groups[0]['slug'])
    }"
  >
    <div class="grid md:grid-cols-2 grid-cols-1 gap-8" style="{{ $style }}">
      <div class="max-w-sm">
        <InnerBlocks allowedBlocks="{{ wp_json_encode($allowedBlocks) }}" />

        <nav>
          <ul class="flex flex-col gap-4">
            @foreach($groups as $group)
              <li>
                <a
                  x-on:click="active = @Js($group['slug'] ?? '')" 
                  href="#{{ $group['slug'] }}"
                  class="block border-b border-current no-underline hover:no-underline relative pt-1 pb-2 font-bold"
                  :class="{
                    'before:content-empty before:block before:bg-current': active === @Js($group['slug'] ?? ''),
                    'before:w-1/5 before:h-1 before:absolute before:left-0 before:bottom-0': active === @Js($group['slug'] ?? ''),
                  }"
                >
                  {!! $group['title'] ?? '' !!}
                </a>
              </li>
            @endforeach
          </ul>
        </nav>
      </div>

      <div>
        @foreach($groups as $group)
          <div 
            id="{{ $group['slug'] ?? '' }}" 
            x-show="active === @Js($group['slug'])"
            class="flex flex-col gap-4"
          >
            @foreach(($group['items'] ?? []) as $item)
              <x-seeme::accordeon title="{{ $item['title'] }}">{!! $item['content'] !!}</x-seeme::accordeon>
            @endforeach
          </div>
        @endforeach
      </div>
    </div>
  </div>
@endif