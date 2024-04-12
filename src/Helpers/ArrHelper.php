<?php

namespace Seeme\Components\Helpers;

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
}