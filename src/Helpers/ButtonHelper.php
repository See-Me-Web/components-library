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
        'btn-primary inline-flex items-center justify-center gap-4',
        'outline outline-1 bg-trasparent outline-primary text-primary',
        'text-base whitespace-nowrap transition-colors',
        'rounded-full no-underline hover:no-underline'
      ]
    ],
    'secondary' => [
      'label' => 'Secondary',
      'classes' => [
        'btn-secondary'
      ]
    ]
  ];

  private static $sizes = [
    'small' => [
      'label' => 'Small',
      'classes' => 'btn-small p-4 text-sm'
    ],
    'medium' => [
      'label' => 'Medium',
      'classes' => 'btn-medium p-6 text-sm md:text-base'
    ],
    'large' => [
      'label' => 'Large',
      'classes' => 'btn-large p-8 text-base md:text-lg'
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