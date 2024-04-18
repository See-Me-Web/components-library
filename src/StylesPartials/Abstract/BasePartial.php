<?php

namespace Seeme\Components\StylesPartials\Abstract;

use Illuminate\Support\Arr;
use Seeme\Components\Helpers\ArrHelper;
use StoutLogic\AcfBuilder\FieldsBuilder;

abstract class BasePartial 
{
  /**
   * Return StoutLogic\AcfBuilder\FieldsBuilder with partial fields
   * 
   * @return FieldsBuilder|null
   */
  public static function getFields(): ?FieldsBuilder
  {
    return null;
  }

  /**
   * Return title for partials ACF Fields
   * 
   * @return string
   */
  public static function getFieldsTitle(): string
  {
    return '';
  }

  /**
   * Return CSS style for this partial
   * 
   * @return string
   */
  public static function getStyle(): string 
  {
    return '';
  }
  
  /**
   * Return CSS classes for this partial
   * 
   * @return string
   */
  public static function getClasses(): string 
  {
    return '';
  }

  /**
   * Return variables passed to view required by style
   * 
   * @return array
   */
  public static function getStylesConfig(): array
  {
    return [];
  }

  /**
   * Return single dimension array in format key => label from partial options
   * 
   * @return array
   */
  public static function getOptionsLabels(array $arr): array
  {
    return ArrHelper::flattenAssoc($arr, 'label');
  }

  /**
   * Return single dimension array in format key => classes from partial options
   * 
   * @return array
   */
  public static function getOptionsClasses(array $arr): array
  {
    return ArrHelper::flattenAssoc($arr, 'classes');
  }

  public static function getSettingClasses(array $arr, string $setting): string
  {
    $classes = Arr::get(static::getOptionsClasses($arr), $setting, '');

    if( is_array($classes) ) {
      return Arr::toCssClasses($classes);
    }

    return $classes;
  }
}