<?php

namespace Seeme\Components\Helpers;

use Illuminate\Support\Arr;
use Seeme\Components\Helpers\Abstract\ComponentHelper;

class HeadingHelper extends ComponentHelper
{
  private static $sizes = [
    'xs' => [
      'label' => 'Extra small',
      'classes' => 'heading-xs text-xs'
    ],
    'sm' => [
      'label' => 'Small',
      'classes' => 'heading-sm text-sm'
    ],
    'md' => [
      'label' => 'Medium',
      'classes' => 'heading-md text-base'
    ],
    'lg' => [
      'label' => 'Large',
      'classes' => 'heading-lg text-lg'
    ],
    'xl' => [
      'label' => 'Extra large',
      'classes' => 'heading-xl text-xl'
    ]
  ];

  private static $weights = [
    'light' => [
      'label' => 'Light',
      'classes' => 'font-light'
    ],
    'normal' => [
      'label' => 'Normal',
      'classes' => 'font-normal'
    ],
    'semibold' => [
      'label' => 'Semibold',
      'classes' => 'font-semibold'
    ],
    'bold' => [
      'label' => 'Bold',
      'classes' => 'font-bold'
    ],
    'black' => [
      'label' => 'Black',
      'classes' => 'font-black'
    ]
  ];

  public static function getSizes(): array
  {
    return apply_filters('sm/components/heading/sizes', static::$sizes);
  }

  public static function getDefaultSize(): string
  {
    return apply_filters('sm/components/heading/defaultSize', 'md');
  }

  public static function getWeights(): array
  {
    return apply_filters('sm/components/heading/weights', static::$weights);
  }

  public static function getDefaultWeight(): string
  {
    return apply_filters('sm/components/heading/defaultWeight', 'normal');
  }

  public static function getClasses(string $size = 'md', string $weight = 'normal'): string
  {
    return Arr::toCssClasses([
      Arr::get(static::getSizes(), $size . '.classes', ''),
      Arr::get(static::getWeights(), $weight . '.classes', ''),
    ]);
  }
}