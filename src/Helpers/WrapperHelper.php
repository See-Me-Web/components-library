<?php

namespace Seeme\Components\Helpers;

use Illuminate\Support\Arr;
use Seeme\Components\Helpers\Abstract\ComponentHelper;

class WrapperHelper extends ComponentHelper
{
  private static $widths = [
    'sm' => [
      'label' => 'Small',
      'classes' => 'max-w-screen-sm'
    ],
    'md' => [
      'label' => 'Medium',
      'classes' => 'max-w-screen-md'
    ],
    'lg' => [
      'label' => 'Large',
      'classes' => 'max-w-screen-lg'
    ],
    'xl' => [
      'label' => 'Extra large',
      'classes' => 'max-w-screen-xl'
    ],
    '2xl' => [
      'label' => 'Extra large (2x)',
      'classes' => 'max-w-screen-2xl'
    ],
    'full' => [
      'label' => 'Full',
      'classes' => 'max-w-full'
    ]
  ];

  public static function getWidths(): array
  {
    return apply_filters('sm/components/wrapper/widths', static::$widths);
  }

  public static function getDefaultWidth(): string
  {
    return apply_filters('sm/components/wrapper/defaultWidth', 'xl');
  }

  public static function getClasses(string $width = 'md'): string
  {
    return Arr::toCssClasses([
      Arr::get(static::getWidths(), $width . '.classes', ''),
    ]);
  }
}