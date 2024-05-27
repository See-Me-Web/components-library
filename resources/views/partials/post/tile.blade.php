@switch($postType ?? 'post')
  @case('portfolio')
    @include('seeme::partials.portfolio.tile', ['id' => $id, 'override' => $override])
    @break;
  @case('post')
  @default
    @include('seeme::partials.article.tile', ['id' => $id, 'override' => $override])
@endswitch
