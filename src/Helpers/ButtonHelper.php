<?php

namespace Seeme\Components\Helpers;

class ButtonHelper
{
  public static function getVariants(): array
  {
    $variants = [
      
    ];    

    return apply_filters('sm/components/button/variants', $variants);
  }
}