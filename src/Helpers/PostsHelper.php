<?php

namespace Seeme\Components\Helpers;

use Seeme\Components\Partials\Card;

class PostsHelper
{
  public const CATEGORIES_MAP = [
    'post' => 'category',
    'portfolio' => 'portfolio_category',
    'offer' => 'offer_category'
  ];

  public static function prepareForTile(int $postId)
  {
    return [
      'type' => get_post_type($postId),
      'permalink' => get_the_permalink($articleId),
      'title' => get_the_title($articleId),
      'excerpt' => apply_filters('orphan_replace', get_the_excerpt($articleId)),
      'thumbnail' => PostsHelper::getThumbnail($articleId),
      'cardWidth' => Card::getCardWidth($articleId)
    ];
  }

  public static function getCategoryTaxonomy(string $postType = 'post'): string
  {
    return static::CATEGORIES_MAP[$postType] ?? '';
  }

  public static function getTopLevelCategories(int $postId): array
  {
    $taxonomy = static::getCategoryTaxonomy(get_post_type($postId));

    if(empty($taxonomy)) {
      return [];
    }

    $categories = get_the_terms($postId, $taxonomy);

    return array_filter($categories, fn ($category) => $category->parent === 0);
  }

  public static function getSubcategories(int $postId): array
  {
    $taxonomy = static::getCategoryTaxonomy(get_post_type($postId));

    if(empty($taxonomy)) {
      return [];
    }

    $categories = get_the_terms($postId, $taxonomy);

    return array_filter($categories, fn ($category) => $category->parent !== 0);
  }

  public static function getThumbnail(int $postId, string $size = 'large'): bool | object
  {
    if(! has_post_thumbnail($postId)) {
      return false;
    }

    return ViewHelper::prepareImage(get_post_thumbnail_id($postId), $size);
  }

  public static function getExcerpt(int $postId): string
  {
    return apply_filters('orphan_replace', get_the_excerpt($postId));
  }
}