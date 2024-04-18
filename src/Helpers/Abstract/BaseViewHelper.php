<?php

namespace Seeme\Components\Helpers\Abstract;

use Seeme\Components\Helpers\ArrHelper;

class BaseViewHelper
{
  public static function getOptions(array $arr): array
  {
    return ArrHelper::flattenAssoc($arr, 'label');
  }
}