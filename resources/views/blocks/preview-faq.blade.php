@if(isset($groups) && is_array($groups) && !empty($groups))
  <div
    id="{{ $block->block->anchor ?? $block->block->id }}"
    @class([
      $block->classes,
    ])
  >
    <div class="grid md:grid-cols-2 grid-cols-1 gap-4" style="{{ $style }}">
      <div class="max-w-sm">
        <InnerBlocks allowedBlocks="{{ wp_json_encode($allowedBlocks) }}" />

        <nav>
          <ul class="flex flex-col gap-4">
            @foreach($groups as $group)
              <li>
                <a
                  x-on:click="active = @Js($group['slug'] ?? '')" 
                  href="#{{ $group['slug'] }}"
                  class="block border-b border-current !no-underline hover:no-underline relative pt-1 pb-2 font-bold"
                >
                  {!! $group['title'] ?? '' !!}
                </a>
              </li>
            @endforeach
          </ul>
        </nav>
      </div>

      <div>
        @foreach($groups as $key => $group)
          <div 
            id="{{ $group['slug'] ?? '' }}" 
            @class([
              'flex flex-col gap-4',
              'hidden' => $key !== 0,
              'block' => $key === 0
            ])
          >
            @foreach(($group['items'] ?? []) as $item)
              <div 
                class="border border-current rounded-2xl"
              >
                <div 
                  class="font-bold cursor-pointer flex items-center justify-between gap-4 p-4"
                >
                  <h3>
                    {!! $item['title'] ?? '' !!}
                  </h3>
                  <span>
                    <x-seeme::icon.chevron-down class="w-5 h-5" />
                  </span>
                </div>
                <div 
                  class="after:content-empty after:block after:h-4 px-4 hidden"
                >
                  {!! $item['content'] ?? '' !!}
                </div>
              </div>
            @endforeach
          </div>
        @endforeach
      </div>
    </div>
  </div>
@endif