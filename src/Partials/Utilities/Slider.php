<?php

namespace Seeme\Components\Partials\Utilities;

use Seeme\Components\Partials\Abstract\UtilityPartial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Slider extends UtilityPartial
{
  public static $slug = 'slider';

  public static $options = [
    'effect' => [
      'label' => 'Efekt przejścia',
      'choices' => [
        'slide' => 'Slajd',
        'fade' => 'Zanikanie'
      ],
      'default_value' => 'fade'
    ]
  ];

  public static function getFields(): ?FieldsBuilder
  {
    $builder = new FieldsBuilder(static::$slug);

    $builder
      ->addTrueFalse('autoplay', [
        'label' => 'Przełączaj slajdy automatycznie',
        'default_value' => true
      ])
      ->addNumber('autoplaySpeed', [
        'label' => 'Czas do zmiany slajdu',
        'append' => 'ms',
        'step' => 500,
        'min' => 1000,
        'max' => 20000,
        'default_value' => 5000,
        'conditional_logic' => [
          [
            [
              'field' => 'autoplay',
              'operator' => '==',
              'value' => 1
            ]
          ]
        ]
      ])
      ->addNumber('speed', [
        'label' => 'Czas przejścia',
        'append' => 'ms',
        'step' => 100,
        'min' => 100,
        'max' => 2000,
        'default_value' => 500,
      ])
      ->addTrueFalse('loop', [
        'label' => 'Zapętlenie slajdów',
        'default_value' => false
      ])
      ->addTrueFalse('showArrows', [
        'label' => 'Pokaż strzałki',
        'default_value' => false
      ])
      ->addTrueFalse('showArrowsMobile', [
        'label' => 'Pokaż strzałki (mobile)',
        'default_value' => false
      ]);

    return $builder;
  }

  public static function getClasses(string $fieldName, string $location = ''): array
  {
    $settings = static::getSettings($fieldName, $location);
    $classes = [];

    $classes[] = "has-slider";

    if(isset($settings['showArrows']) && $settings['showArrows'] == true) {
      $classes[] = "has-slider-arrows";
    }

    if(isset($settings['showArrowsMobile']) && $settings['showArrowsMobile'] == true) {
      $classes[] = "has-slider-arrows-mobile";
    }

    return $classes;
  }

  public static function getVariables(string $fieldName, string $location = ''): array
  {
    $settings = static::getSettings($fieldName, $location);

    return [
      'showArrows' => $settings['showArrows'] ?? false,
      'showArrowsMobile' => $settings['showArrowsMobile'] ?? false,
      'config' => [
        'autoplay' => ($settings['autoplay'] ?? true) == true ? [
          'delay' => $settings['autoplaySpeed'] ?? 5000
        ] : false,
        'loop' => boolval($settings['loop'] ?? false),
        'effect' => $settings['effect'] ?? static::getDefault('effect'),
        'speed' => $settings['speed'] ?? 500,
      ]
    ];
  }
}