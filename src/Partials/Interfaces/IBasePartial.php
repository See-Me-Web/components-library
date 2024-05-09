<?php

namespace Seeme\Components\Partials\Interfaces;

use StoutLogic\AcfBuilder\FieldsBuilder;

interface IBasePartial {
  public function getSettings(): array;
  public function getFields(): ?FieldsBuilder;
  public function getClasses(): array;
  public function getStyles(): array;
  public function getVariables(): array;
}