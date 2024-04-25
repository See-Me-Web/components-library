<?php

namespace Seeme\Components\Partials\Abstract;

use Seeme\Components\Partials\Interfaces\IComponentsPartial;

abstract class ComponentsPartial extends BasePartial implements IComponentsPartial
{
  public static function getSettings(array $args = []): array
  {
    return [
      ...get_field(static::$slug) ?: [],
      ...$args
    ];
  }

  public static function getOptionsClasses(array $args = []): array
  {
    $settings = static::getSettings($args);
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
  public static function getStyles(array $args = []): string 
  {
    return '';
  }
  
  /**
   * Return CSS classes for this partial
   * 
   * @return string
   */
  public static function getClasses(array $args = []): string 
  {
    return '';
  }

  /**
   * Return variables passed to view required by style
   * 
   * @return array
   */
  public static function getVariables(array $args = []): array
  {
    return static::getSettings($args);
  }
}