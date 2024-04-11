<?php

namespace Seeme\Components\Helpers;

use Illuminate\Support\Arr;

class HeadingHelper
{
  private static $sizes = [
    'xs' => 'heading-xs text-xs',
    'sm' => 'heading-sm text-sm',
    'md' => 'heading-md text-base',
    'lg' => 'heading-lg text-lg',
    'xl' => 'heading-xl text-xl'
  ];

  private static $sizesLabels = [
    'xs' => 'Extra small',
    'sm' => 'Small',
    'md' => 'Medium',
    'lg' => 'Large',
    'xl' => 'Extra large'
  ];

  public static function getSizes(): array
  {
    return apply_filters('sm/components/heading/sizes', static::$sizes);
  }

  public static function getSizesLabels(): array
  {
    return apply_filters('sm/components/heading/sizesLabels', static::$sizesLabels);
  }

  public static function getDefaultSize(): string
  {
    return apply_filters('sm/components/heading/defaultSize', 'md');
  }

  public static function getClasses(string $size = 'md'): string
  {
    return Arr::get(static::getSizes(), $size, '');
  }
}