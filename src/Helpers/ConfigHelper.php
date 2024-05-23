<?php

namespace Seeme\Components\Helpers;

use Illuminate\Support\Arr;

class ConfigHelper
{
  public static function getPostTypes(bool $onlySlug = false): array
  {
    $configTypes = config('sm-components.postTypes');

    $types = [
      'post' => 'Wpis',
      'portfolio' => 'Realizacje',
      'offer' => 'Oferta',
      ...(is_array($configTypes) ? $configTypes : [])
    ];

    if($onlySlug) {
      return array_keys($types);
    }

    return $types;
  }

  public static function getPostTypeTaxonomies(bool $onlySlug = false): array
  {
      $configTaxonomies = config('sm-components.postTaxonomies');

      $taxonomies = [
        'post' => 'category',
        'portfolio' => 'portfolio_category',
        'offer' => 'offer_category',
        ...(is_array($configTaxonomies) ? $configTaxonomies : [])
      ];

      if( $onlySlug ) {
        return array_keys($taxonomies);
      }

      return $taxonomies;
  }

  public static function getPostTypeTaxonomy(string $postType = 'post')
  {
    return Arr::get(static::getPostTypeTaxonomies(), $postType, 'category');
  }
}