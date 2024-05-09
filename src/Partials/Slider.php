<?php

namespace Seeme\Components\Partials;

use Seeme\Components\Partials\Abstract\BasePartial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Slider extends BasePartial
{
  public string $slug = 'slider';

  public array $options = [
    'effect' => [
      'label' => 'Efekt przejścia',
      'choices' => [
        'slide' => 'Slajd',
        'fade' => 'Zanikanie'
      ],
      'default_value' => 'fade'
    ]
  ];

  public function getFields(): ?FieldsBuilder
  {
    $builder = new FieldsBuilder($this->slug);

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

  public function getClasses(): array
  {
    $settings = $this->getSettings();
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

  public function getVariables(): array
  {
    $settings = $this->getSettings();

    return [
      'showArrows' => $settings['showArrows'] ?? false,
      'showArrowsMobile' => $settings['showArrowsMobile'] ?? false,
      'config' => [
        'autoplay' => ($settings['autoplay'] ?? true) == true ? [
          'delay' => $settings['autoplaySpeed'] ?? 5000
        ] : false,
        'loop' => boolval($settings['loop'] ?? false),
        'effect' => $settings['effect'] ?? 'fade',
        'speed' => $settings['speed'] ?? 500,
      ]
    ];
  }
}