@props([
  'openByDefault' => false,
  'title' => ''
])

<div 
  class="border border-current rounded-2xl"
>
  <div 
    class="font-bold cursor-pointer flex items-center justify-between gap-4 p-4"
  >
    <h3>
      {!! $title !!}
    </h3>
    <span>
      <x-seeme::icon.close class="w-4 h-4" />
    </span>
  </div>
  <div 
    class="after:content-empty after:block after:h-4 px-4"
  >
    {!! $slot !!}
  </div>
</div>