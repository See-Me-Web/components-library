<?php

namespace Seeme\Components\Helpers;

use Illuminate\Support\Arr;
use Seeme\Components\Helpers\Abstract\StylesHelper;
use StoutLogic\AcfBuilder\FieldsBuilder;

class BorderHelper extends StylesHelper
{
  private static $radiuses = [
    'none' => [
      'label' => 'None',
      'classes' => 'rounded-none'
    ],
    'sm' => [
      'label' => 'Small',
      'classes' => 'rounded-sm'
    ],
    'md' => [
      'label' => 'Medium',
      'classes' => 'rounded-md'
    ],
    'lg' => [
      'label' => 'Large',
      'classes' => 'rounded-lg'
    ],
    'xl' => [
      'label' => 'Extra large',
      'classes' => 'rounded-xl'
    ],
    'full' => [
      'label' => 'Full',
      'classes' => 'rounded-full'
    ],
  ];

  public static function getClasses(): string
  {
    return Arr::toCssClasses([
      Arr::get(static::$radiuses, get_field('borderRadius') . '.classes', '')
    ]);
  }

  public static function getFields(): FieldsBuilder
  {
    $builder = new FieldsBuilder('border-styles');

    $builder 
      ->addSelect('borderRadius', [
        'label' => 'Zaokrąglenie',
        'choices' => static::getOptions(static::$radiuses),
        'default_value' => 'none'
      ]);

    return $builder;
  }
}