<?php

namespace Seeme\Components\Helpers;

class TemplateHelper
{
  public static function getPartialTemplate(string $name, array $data)
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