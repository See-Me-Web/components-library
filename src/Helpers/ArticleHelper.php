<?php

namespace Seeme\Components\Helpers;

use Illuminate\Support\Facades\Cache;
use Seeme\Components\Partials\Card;

class ArticleHelper
{
  /**
   * Return data needed to display post tile by id
   * 
   * @param int $articleId post id
   * @param array $override data to one time override
   * @return array
   */
  public static function prepareForTile(int $articleId, array $override = []): array
  {
    $cachedData = Cache::remember(
      "article-{$articleId}-tile",
      8 * HOUR_IN_SECONDS,
      fn() => [
        'id' => $articleId,
        'type' => 'post',
        'permalink' => get_the_permalink($articleId),
        'date' => get_the_date(get_option('date_format'), $articleId),
        'title' => get_the_title($articleId),
        'excerpt' => apply_filters('orphan_replace', get_the_excerpt($articleId)),
        'thumbnail' => PostsHelper::getThumbnail($articleId),
        'hasThumbnail' => has_post_thumbnail($articleId),
        'cardWidth' => Card::getCardWidth($articleId),
      ]
    );

    return empty($override) ? $cachedData : [
      ...$cachedData,
      ...$override
    ];
  }
}