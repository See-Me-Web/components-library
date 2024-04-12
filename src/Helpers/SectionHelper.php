<?php

namespace Seeme\Components\Helpers;

use Illuminate\Support\Arr;
use Seeme\Components\Helpers\Abstract\ComponentHelper;

class SectionHelper extends ComponentHelper
{
  private static $borderRadiuses = [
    'none' => [
      'label' => 'None',
      'classes' => 'rounded-none'
    ],
    'sm' => [
      'label' => 'Small',
      'classes' => 'rounded-sm'
    ],
    'md' => [
      'label' => 'Medium',
      'classes' => 'rounded-md'
    ],
    'lg' => [
      'label' => 'Large',
      'classes' => 'rounded-lg'
    ],
    'xl' => [
      'label' => 'Extra large',
      'classes' => 'rounded-xl'
    ],
    'full' => [
      'label' => 'Full',
      'classes' => 'rounded-full'
    ],
  ];

  public static function getBorderRadiuses(): array
  {
    return apply_filters('sm/components/section/borderRadiuses', static::$borderRadiuses);
  }

  public static function getDefaultBorderRadius(): string
  {
    return apply_filters('sm/components/section/defaultBorderRadius', 'none');
  }

  public static function getClasses(string $borderRadius = 'none'): string
  {
    return Arr::toCssClasses([
      Arr::get(static::getBorderRadiuses(), $borderRadius . '.classes', ''),
    ]);
  }
}