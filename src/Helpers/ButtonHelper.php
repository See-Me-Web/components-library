<?php

namespace Seeme\Components\Helpers;

use Illuminate\Support\Arr;
use Seeme\Components\Helpers\Abstract\ComponentHelper;

class ButtonHelper extends ComponentHelper
{
  private static $variants = [
    'primary' => [
      'label' => 'Primary',
      'classes' => [
        'btn-primary'
      ]
    ],
    'secondary' => [
      'label' => 'Primary',
      'classes' => [
        'btn-secondary'
      ]
    ]
  ];

  private static $sizes = [
    'small' => [
      'label' => 'Small',
      'classes' => 'btn-small'
    ],
    'medium' => [
      'label' => 'Medium',
      'classes' => 'btn-medium'
    ],
    'large' => [
      'label' => 'Large',
      'classes' => 'btn-large'
    ]
  ];

  public static function getVariants(): array
  {
    return apply_filters('sm/components/button/variants', static::$variants);
  }

  public static function getDefaultVariant(): string{
    return apply_filters('sm/components/button/defaultVariant', 'primary');
  }

  public static function getSizes(): array
  {
    return apply_filters('sm/components/button/sizes', static::$sizes);
  }

  public static function getDefaultSize(): string
  {
    return apply_filters('sm/components/button/defaultSize', 'medium');
  }

  public static function getClasses(string $variant = 'primary', string $size = 'medium'): string
  {
    return Arr::toCssClasses([
      Arr::toCssClasses(Arr::get(static::getVariants(), $variant . '.classes', [])),
      Arr::get(static::getSizes(), $size . '.classes', ''),
    ]);
  }
}