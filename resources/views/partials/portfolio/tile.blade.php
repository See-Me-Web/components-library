<x-seeme::card :variant="$blockVariant ?? ''" :width="$cardWidth ?? 1">
  @if(isset($thumbnail) && $thumbnail)
    <a 
      href="{{ isset($permalink) && $permalink ? $permalink : '#' }}" 
      title="{{ isset($title) && $title ? $title : '' }}"
    >
      <img 
        src="{{ $thumbnail->url }}"
        width="{{ $thumbnail->width }}"
        height="{{ $thumbnail->height }}"
        alt="{{ $thumbnail->alt }}"
        loading="lazy"
        class="mb-4 max-w-full w-full h-full max-h-[15rem] object-cover object-center" 
      />
    </a>
  @endif

  @if(!empty($categories))
    <div class="uppercase">
      {!! $listedCategories !!}
    </div>
  @endif

  @if(isset($title) && $title)
    <a 
      href="{{ isset($permalink) && $permalink ? $permalink : '#' }}" 
      title="{{ isset($title) && $title ? $title : '' }}"
      class="hover:no-underline"
    >
      <h3 class="text-current text-base mb-4 font-bold">{!! $title !!}</h3>
    </a>
  @endif

  @if(isset($excerpt) && $excerpt)
    <div class="text-current line-clamp-4">
      {!! $excerpt !!}
    </div>
  @endif
</x-seeme::card>
