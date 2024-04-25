<?php

namespace Seeme\Components\Partials\Abstract;

use Illuminate\Support\Arr;
use Seeme\Components\Partials\Interfaces\IUtilitiesPartial;

abstract class UtilityPartial extends BasePartial implements IUtilitiesPartial
{
  public static function getSettings(string $fieldName, string $location = ''): array
  {
    $fields = get_field($fieldName) ?: [];
    $location = empty($location) ? static::$slug : $location . '.' . static::$slug;

    return Arr::get($fields, $location, []);
  }

  public static function getOptionsClasses(string $fieldName, string $location = ''): array
  {
    $settings = static::getSettings($fieldName, $location);
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
  public static function getStyles(string $fieldName, string $location = ''): array 
  {
    return [];
  }
  
  /**
   * Return CSS classes for this partial
   * 
   * @return string
   */
  public static function getClasses(string $fieldName, string $location = ''): array 
  {
    return [];
  }

  /**
   * Return variables passed to view required by style
   * 
   * @return array
   */
  public static function getVariables(string $fieldName, string $location = ''): array
  {
    return [];
  }
}