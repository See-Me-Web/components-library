<?php

namespace Seeme\Components\Partials\Interfaces;

interface IComponentsPartial {
  public static function getClasses(array $args = []): string;
  public static function getStyles(array $args = []): string;
  public static function getVariables(array $args = []): array;
  public static function getSettings(array $args = []): array;
}