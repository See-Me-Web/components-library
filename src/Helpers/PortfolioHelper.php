<?php

namespace Seeme\Components\Helpers;

use Seeme\Components\Partials\Card;

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
      'cardWidth' => Card::getCardWidth($postId),
      'excerpt' => PostsHelper::getExcerpt($postId),
      'thumbnail' => PostsHelper::getThumbnail($postId),
      'categories' => PostsHelper::getTopLevelCategories($postId),
      'listedCategories' => ViewHelper::listCategories(PostsHelper::getTopLevelCategories($postId)),
    ];
  }
}