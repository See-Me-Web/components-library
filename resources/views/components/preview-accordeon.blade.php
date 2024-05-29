@props([
  'openByDefault' => false,
  'title' => '',
  'simple' => false
])

<div 
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
  >
    <h3>
      {!! $title !!}
    </h3>
    <span>
      @if($simple)
        <x-seeme::icon.chevron-up class="size-4" />
      @else
        <x-seeme::icon.close class="size-4" />
      @endif
    </span>
  </div>

  <div 
    @class([
      'after:content-empty after:block after:h-4 px-4' => !$simple,
      'before:content-empty before:block before:h-1' => $simple,
      'after:content-empty after:block after:h-3' => $simple,
    ])
  >
    {!! $slot !!}
  </div>
</div>