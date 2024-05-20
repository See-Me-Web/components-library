<x-seeme::card 
  :variant="$cardVariant ?? ''"
  :post="$id"
>
  @switch($postType ?? 'post')
    @case('portfolio')
      @include('seeme::partials.portfolio.tile', ['id' => $id])
      @break;
    @case('post')
    @default
      @include('seeme::partials.article.tile', ['id' => $id])
  @endswitch
</x-seeme::card>