<?php

namespace Seeme\Components\Helpers\Abstract;

use StoutLogic\AcfBuilder\FieldsBuilder;

abstract class StylesHelper extends BaseViewHelper
{
  abstract public static function getClasses(): string;
  abstract public static function getFields(): FieldsBuilder;
  abstract public static function getCurrentSettings(): array;
  // abstract public static function getStyles();

  public static function isEnabled(string $key): bool
  {
    $setting = get_field($key);
    return isset($setting) && $setting == true;
  }
}