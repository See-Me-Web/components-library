@props([
  'openByDefault' => false,
  'title' => ''
])

<div 
  x-data="{
    open: @Js($openByDefault)
  }"
  class="border border-current rounded-2xl"
>
  <div 
    class="font-bold cursor-pointer flex items-center justify-between gap-4 p-4"
    x-on:click="open = ! open"
  >
    <h3>
      {!! $title !!}
    </h3>
    <span>
      <x-seeme::icon.chevron-down class="w-5 h-5" x-show="! open" />
      <x-seeme::icon.close class="w-4 h-4" x-show="open" />
    </span>
  </div>
  <div 
    x-collapse 
    x-show="open"
    x-cloak
    class="after:content-empty after:block after:h-4 px-4"
  >
    {!! $slot !!}
  </div>
</div>