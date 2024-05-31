<?php

namespace Seeme\Components\Helpers;

use Illuminate\Support\Facades\Cache;
use Seeme\Components\Partials\Card;

class PostsHelper
{
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
      "post-{$postId}-tile",
      8 * HOUR_IN_SECONDS,
      fn() => [
        'id' => $postId,
        'type' => get_post_type($postId),
        'permalink' => get_the_permalink($postId),
        'title' => get_the_title($postId),
        'excerpt' => apply_filters('orphan_replace', get_the_excerpt($postId)),
        'thumbnail' => PostsHelper::getThumbnail($postId),
        'cardWidth' => Card::getCardWidth($postId),
      ]
    );

    return empty($override) ? $cachedData : [
      ...$cachedData,
      ...$override
    ];
  }

  /**
   * Return top level categories for post
   * 
   * @param int $postId
   * @return array
   */
  public static function getTopLevelCategories(int $postId): array
  {
    $taxonomy = ConfigHelper::getPostTypeTaxonomy(get_post_type($postId));

    if(empty($taxonomy)) {
      return [];
    }

    $categories = get_the_terms($postId, $taxonomy);

    return array_filter($categories, fn ($category) => $category->parent === 0);
  }

  /**
   * Return all subcategories for post
   * 
   * @param int $postId
   * @return array
   */
  public static function getSubcategories(int $postId): array
  {
    $taxonomy = ConfigHelper::getPostTypeTaxonomy(get_post_type($postId));

    if(empty($taxonomy)) {
      return [];
    }

    $categories = get_the_terms($postId, $taxonomy);

    return array_filter($categories, fn ($category) => $category->parent !== 0);
  }

  /**
   * Return post thumbnail, prepared for view with ViewHelper
   * 
   * @param int $postId
   * @param string $size
   * @return bool | object
   */
  public static function getThumbnail(int $postId, string $size = 'large'): bool | object
  {
    if(! has_post_thumbnail($postId)) {
      return false;
    }

    return ViewHelper::prepareImage(get_post_thumbnail_id($postId), $size);
  }

  /**
   * Return post excerpt with orphan_replace filter applied
   * 
   * @param int $postId
   * @return string
   */
  public static function getExcerpt(int $postId): string
  {
    return apply_filters('orphan_replace', get_the_excerpt($postId));
  }
}