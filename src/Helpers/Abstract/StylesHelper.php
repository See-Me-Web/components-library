<?php

namespace Seeme\Components\Helpers\Abstract;

use Seeme\Components\Helpers\ArrHelper;
use StoutLogic\AcfBuilder\FieldsBuilder;

abstract class StylesHelper
{
  abstract public static function getClasses(): string;
  abstract public static function getFields(): FieldsBuilder;
  
  public static function getOptions(array $arr): array
  {
    return ArrHelper::flattenAssoc($arr, 'label');
  }
}