<?php

namespace Seeme\Components\Helpers;

use Illuminate\Support\Arr;

class ConfigHelper
{
  public const CONFIG_SLUG = 'sm-components';

  public const DEFAULT_POST_TYPES = [
    'post' => 'Wpis',
    'portfolio' => 'Realizacje',
    'offer' => 'Oferta',
  ];

  public const DEFAULT_TAXONOMIES = [
    'post' => 'category',
    'portfolio' => 'portfolio_category',
    'offer' => 'offer_category',
  ];

  /**
   * Return post types from config file
   * 
   * @param bool $onlySlug
   * @return array
   */
  public static function getPostTypes(bool $onlySlug = false): array
  {
    $configTypes = config(self::CONFIG_SLUG . '.postTypes');

    $types = [
      self::DEFAULT_POST_TYPES,
      ...(is_array($configTypes) ? $configTypes : [])
    ];

    return $onlySlug ? array_keys($types) : $types;
  }

  /**
   * Return taxonomies related to post types
   * 
   * @param bool $onlySlug
   * @return array
   */
  public static function getPostTypeTaxonomies(bool $onlySlug = false): array
  {
    $configTaxonomies = config(self::CONFIG_SLUG . '.postTaxonomies');

    $taxonomies = [
      self::DEFAULT_TAXONOMIES,
      ...(is_array($configTaxonomies) ? $configTaxonomies : [])
    ];

    return $onlySlug ? array_values($taxonomies) : $taxonomies;
  }

  /**
   * Return taxonomy slug related to post type from config
   * 
   * @param string $postType
   * @return string taxonomy slug
   */
  public static function getPostTypeTaxonomy(string $postType = 'post'): string
  {
    return Arr::get(static::getPostTypeTaxonomies(), $postType, 'category');
  }
}