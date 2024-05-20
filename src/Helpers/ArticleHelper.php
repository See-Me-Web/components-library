<?php

namespace Seeme\Components\Helpers;

class ArticleHelper
{
  public static function prepareForTile(int $articleId)
  {
    return [
      'type' => 'post',
      'permalink' => get_the_permalink($articleId),
      'date' => get_the_date(get_option('date_format'), $articleId),
      'title' => get_the_title($articleId),
      'excerpt' => apply_filters('orphan_replace', get_the_excerpt($articleId)),
      'thumbnail' => static::getThumbnail($articleId),
    ];
  }

  public static function getThumbnail(int $articleId): bool | object
  {
    if(! has_post_thumbnail($articleId)) {
      return false;
    }

    return ViewHelper::prepareImage(get_post_thumbnail_id($articleId), 'large');
  }
}