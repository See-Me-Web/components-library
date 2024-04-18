<?php

namespace Seeme\Components\Helpers;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ArrHelper
{
  /**
   * Creates associative array containing keys of original array and values of corresponding column
   * 
   * @return array
   */
  public static function flattenAssoc(array $arr, string $column): array
  {
    return array_combine(array_keys($arr), array_column($arr, $column));
  }

  /**
     * Conditionally compile styles from an array into a style list.
     *
     * @param  array  $array
     * @return string
     */
    public static function toCssStyles($array)
    {
        $styleList = Arr::wrap($array);

        $styles = [];

        foreach ($styleList as $class => $constraint) {
            if (is_numeric($class)) {
                $styles[] = Str::finish($constraint, ';');
            } elseif ($constraint) {
                $styles[] = Str::finish($class, ';');
            }
        }

        return implode(' ', $styles);
    }
}