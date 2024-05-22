<x-seeme::card :variant="$blockVariant ?? ''" :width="$cardWidth ?? 1">
  @switch($postType ?? 'post')
    @case('portfolio')
      @include('seeme::partials.portfolio.tile', ['id' => $id])
      @break;
    @case('post')
    @default
      @include('seeme::partials.article.tile', ['id' => $id])
  @endswitch
</x-seeme::card>