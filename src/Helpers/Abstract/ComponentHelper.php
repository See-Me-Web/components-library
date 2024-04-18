<?php

namespace Seeme\Components\Helpers\Abstract;

use StoutLogic\AcfBuilder\FieldsBuilder;

abstract class ComponentHelper extends BaseViewHelper
{
  abstract public static function getClasses(): string;
  abstract public static function getFields(): FieldsBuilder;
  abstract public static function getCurrentSettings(): array;
}