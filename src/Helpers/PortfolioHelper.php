<?php

namespace Seeme\Components\Helpers;

use Illuminate\Support\Arr;
use Seeme\Components\Partials\PostCard;

class PortfolioHelper
{
  public const POST_TYPE = 'portfolio'; 

  public static function prepareForTile(int $postId): array
  {    
    return [
      'id' => $postId,
      'type' => static::POST_TYPE,
      'permalink' => get_the_permalink($postId),
      'title' => get_the_title($postId),
      'excerpt' => PostsHelper::getExcerpt($postId),
      'thumbnail' => PostsHelper::getThumbnail($postId),
      'categories' => PostsHelper::getTopLevelCategories($postId),
      'listedCategories' => ViewHelper::listCategories(PostsHelper::getTopLevelCategories($postId)),
      ...static::getStyling($postId)
    ];
  }

  public static function getStyling(int $postId): array
  {
    $partial = new PostCard([
      'postId' => $postId
    ]);

    return [
      'classes' => Arr::toCssClasses($partial->getClasses()),
      'styles' => ArrHelper::toCssStyles($partial->getStyles())
    ];
  }
}