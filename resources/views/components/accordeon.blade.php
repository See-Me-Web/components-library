@props([
  'openByDefault' => false,
  'title' => '',
  'simple' => false
])

<div 
  x-data="{
    open: @Js($openByDefault)
  }"
  @class([
    'border border-current rounded-2xl' => !$simple
  ])
>
  <div
    @class([
      'cursor-pointer',
      'font-bold flex items-center justify-between gap-4 p-4' => !$simple,
      'flex gap-2 items-center' => $simple
    ])
    x-on:click="open = ! open"
  >
    <h3>
      {!! $title !!}
    </h3>
    <span>
      @if($simple)
        <x-seeme::icon.chevron-right class="size-4" x-show="! open" />
        <x-seeme::icon.chevron-up class="size-4" x-show="open" />
      @else
        <x-seeme::icon.chevron-down class="size-5" x-show="! open" />
        <x-seeme::icon.close class="size-4" x-show="open" />
      @endif
    </span>
  </div>

  <div 
    x-collapse 
    x-show="open"
    x-cloak
    @class([
      'after:content-empty after:block after:h-4 px-4' => !$simple,
      'before:content-empty before:block before:h-1' => $simple,
      'after:content-empty after:block after:h-3' => $simple,
    ])
  >
    {!! $slot !!}
  </div>
</div>