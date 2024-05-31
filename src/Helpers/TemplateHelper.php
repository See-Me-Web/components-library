<?php

namespace Seeme\Components\Helpers;

class TemplateHelper
{
  /**
   * Return partial data for template
   * 
   * @param string $name
   * @param array $data
   * @return array
   */
  public static function getPartialTemplate(string $name, array $data): array
  {
    $prefixedData = [];

    if(!empty($data)) {
      foreach($data as $key => $value) {
        $prefixedData["{$name}_{$key}"] = $value;
      }
    }

    return [
      ...$prefixedData,
      $name => $data
    ];
  }
}