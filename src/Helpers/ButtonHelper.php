<?php

namespace Seeme\Components\Helpers;

use Illuminate\Support\Arr;
use Seeme\Components\Helpers\Abstract\ComponentHelper;

class ButtonHelper extends ComponentHelper
{
  private static $variants = [
    'primary' => [
      'inline-flex'
    ]
  ];

  private static $sizes = [
    'small' => '',
    'medium' => '',
    'large' => ''
  ];

  public static function getVariants(): array
  {
    return apply_filters('sm/components/button/variants', static::$variants);
  }

  public static function getSizes(): array
  {
    return apply_filters('sm/components/button/sizes', static::$sizes);
  }

  public static function getClasses(string $variant = 'primary', string $size = 'medium'): string
  {
    return Arr::toCssClasses([
      Arr::get(static::getVariants(), $variant . '.classes', ''),
      Arr::get(static::getSizes(), $size . '.classes', ''),
    ]);
  }
}