<?php

namespace Seeme\Components\Partials\Interfaces;

interface IUtilitiesPartial {
  public static function getClasses(string $fieldName, string $location = ''): array;
  public static function getStyles(string $fieldName, string $location = ''): array;
  public static function getVariables(string $fieldName, string $location = ''): array;
  public static function getSettings(string $fieldName, string $location = ''): array;
}