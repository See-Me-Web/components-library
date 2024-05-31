<?php

namespace Seeme\Components\Helpers;

use Illuminate\Support\Facades\Cache;
use Seeme\Components\Partials\Card;

class PortfolioHelper
{
  public const POST_TYPE = 'portfolio'; 

  /**
   * Return data needed to display post tile by id
   * 
   * @param int $postId post id
   * @param array $override data to one time override
   * @return array
   */
  public static function prepareForTile(int $postId, array $override = []): array
  {
    $cachedData = Cache::remember(
      "portoflio-{$postId}-tile",
      8 * HOUR_IN_SECONDS,
      fn() => [
        'id' => $postId,
        'type' => static::POST_TYPE,
        'permalink' => get_the_permalink($postId),
        'title' => get_the_title($postId),
        'cardWidth' => Card::getCardWidth($postId),
        'excerpt' => PostsHelper::getExcerpt($postId),
        'thumbnail' => PostsHelper::getThumbnail($postId),
        'categories' => PostsHelper::getTopLevelCategories($postId),
        'listedCategories' => ViewHelper::listCategories(PostsHelper::getTopLevelCategories($postId)),
      ]
    );

    return empty($override) ? $cachedData : [
      ...$cachedData,
      ...$override
    ];
  }
}