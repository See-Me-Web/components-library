<?php

namespace Seeme\Components\Partials\Abstract;

use Seeme\Components\Partials\Interfaces\IStylesPartial;

abstract class StylesPartial extends BasePartial implements IStylesPartial
{
  public static $parentSlug = '';

  public static function getSettings(): array
  {
    if( empty(static::$parentSlug) ) {
      return get_field(static::$slug) ?: [];
    }

    return get_field(static::$parentSlug)[static::$slug] ?? [];
  }

  public static function getOptionsClasses(): array
  {
    $settings = static::getSettings();
    $classes = [];

    foreach($settings as $setting => $value) {
      if(! in_array($setting, array_keys(static::$options))) {
        continue;
      }

      $classes[] = static::getOptionClasses($setting, $value);
    }

    return $classes;
  }

  /**
   * Return CSS style for this partial
   * 
   * @return string
   */
  public static function getStyles(): array 
  {
    return [];
  }
  
  /**
   * Return CSS classes for this partial
   * 
   * @return string
   */
  public static function getClasses(): array 
  {
    return [];
  }

  /**
   * Return variables passed to view required by style
   * 
   * @return array
   */
  public static function getVariables(): array
  {
    return [];
  }
}