<?php

namespace Seeme\Components\Helpers\Abstract;

use Seeme\Components\Helpers\ArrHelper;

abstract class ComponentHelper
{
  abstract public static function getClasses();
  
  public static function getOptions(array $arr): array
  {
    return ArrHelper::flattenAssoc($arr, 'label');
  }
}