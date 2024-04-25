<?php

namespace Seeme\Components\Partials\Interfaces;

interface IStylesPartial {
  public static function getClasses(): array;
  public static function getStyles(): array;
  public static function getVariables(): array;
  public static function getSettings(): array;
}