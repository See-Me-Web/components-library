<section 
  id="{{ $block->block->anchor ?? $block->block->id }}"
  style="{{ $style }}"
  @class([
    'overflow-hidden',
    $block->classes,
])
>
  @include('seeme::partials.blockStyles')
  
  <div class="grid grid-cols-1 md:grid-cols-2">
    <div class="">
      <img src="{{ $thumbnail->url }}" class="object-cover object-center w-full h-full max-h-[200px] md:max-h-[40vh]" />
    </div>
    <div class="flex flex-col justify-center p-8">
      <div class="font-extralight mb-2">{!! $categories !!}</div>
      <x-seeme::heading size="xl">{{ $title }}</x-seeme::heading>
    </div>
  </div>
</section>