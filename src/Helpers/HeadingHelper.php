<?php

namespace Seeme\Components\Helpers;

use Illuminate\Support\Arr;

class HeadingHelper
{
  private static $sizes = [
    'xs' => 'heading-xs text-xs',
    'sm' => 'heading-sm text-sm',
    'md' => 'heading-md text-md',
    'lg' => 'heading-lg text-lg',
    'xl' => 'heading-xl text-xl'
  ];

  public static function getSizes(): array
  {
    return apply_filters('sm/components/heading/sizes', static::$sizes);
  }

  public static function getClasses(string $size = 'md'): string
  {
    return Arr::get(static::getSizes(), $size, '');
  }
}