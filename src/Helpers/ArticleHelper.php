<?php

namespace Seeme\Components\Helpers;

use Seeme\Components\Partials\Card;

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
      'thumbnail' => PostsHelper::getThumbnail($articleId),
      'cardWidth' => Card::getCardWidth($articleId)
    ];
  }
}