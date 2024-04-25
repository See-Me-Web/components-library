<?php

namespace Seeme\Components\Partials\Interfaces;

use StoutLogic\AcfBuilder\FieldsBuilder;

interface IBasePartial {
  public static function getFields(): ?FieldsBuilder;
}