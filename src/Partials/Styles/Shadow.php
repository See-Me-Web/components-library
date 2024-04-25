<?php

namespace Seeme\Components\Partials\Styles;

use Seeme\Components\Partials\Abstract\StylesPartial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Shadow extends StylesPartial
{
  public static $title = 'Cień';
  public static $slug = 'shadow';

  public static $options = [
    'shadowPreset' => [
      'label' => 'Cień',
      'choices' => [
        'none' => 'Brak',
        'sm' => 'Mały',
        'regular' => 'Domyślny',
        'md' => 'Średni',
        'lg' => 'Duży',
        'xl' => 'Bardzo duży'
      ],
      'default_value' => 'none'
    ]
  ];

  public static $optionsClasses = [
    'shadowPreset' => [
      'none' => 'shadow-none',
      'sm' => 'shadow-sm',
      'regular' => 'shadow',
      'md' => 'shadow-md',
      'lg' => 'shadow-lg',
      'xl' => 'shadow-xl'
    ]
  ];

  public static function getFields(): ?FieldsBuilder
  {
    $builder = new FieldsBuilder(static::$slug);

    $builder
      ->addTrueFalse('customShadowColor', [
        'label' => 'Inny kolor cienia'
      ])
      ->addColorPicker('shadowColor', [
        'label' => 'Kolor cienia',
        'conditional_logic' => [
          [
            [
              'field' => 'customShadowColor',
              'operator' => '==',
              'value' => 1
            ]
          ]
        ]
      ]);

    return $builder;
  }

  public static function getClasses(): array
  {
    $settings = static::getSettings();
    $classes = [];

    $classes = array_merge($classes, static::getOptionsClasses());

    if(
      isset($settings['shadowColor']) && !empty($settings['shadowColor']) && 
      isset($settings['customShadowColor']) && $settings['customShadowColor'] === true
    ) {
      $classes[] = "shadow-[color:--shadow-color]";
    } 

    return $classes;
  }

  public static function getStyles(): array
  {
    $settings = static::getSettings();
    $styles = [];

    if(
      isset($settings['shadowColor']) && !empty($settings['shadowColor']) && 
      isset($settings['customShadowColor']) && $settings['customShadowColor'] === true
    ) {
      $styles[] = "--shadow-color: {$settings['shadowColor']}";
    }

    return $styles;
  }
}