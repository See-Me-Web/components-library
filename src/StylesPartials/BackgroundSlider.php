<?php

namespace Seeme\Components\StylesPartials;

use Illuminate\Support\Arr;
use Seeme\Components\StylesPartials\Abstract\BasePartial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class BackgroundSlider extends BasePartial
{
  public static function getEffects(): array
  {
    return apply_filters('sm/components/backgroundSlider/effects', [
      'slide' => 'Slajd',
      'fade' => 'Zanikanie',
    ]);
  }

  public static function getDefaultEffect(): string
  {
    return apply_filters('sm/components/backgroundSlider/defaultEffect', 'fade');
  }

  public static function getFields(): ?FieldsBuilder
  {
    $builder = new FieldsBuilder('background-slider');

    $builder
      ->addGroup('background-slider', [
        'conditional_logic' => [
          [
            [
              'field' => 'mode',
              'operator' => '==',
              'value' => 'slider'
            ]
          ]
        ]
      ])
      ->addGallery('slides', [
        'label' => 'Slajdy'
      ])
      ->addSelect('effect', [
        'label' => 'Efekt przejścia',
        'choices' => static::getEffects(),
        'default_value' => static::getDefaultEffect()
      ])
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
      ]);
        
    return $builder;
  }

  public static function getClasses(): string
  {
    $settings = get_field('background-slider');

    return Arr::toCssClasses([
      'has-slider' => static::hasSlider(),
      'has-arrows' => $settings['showArrows'] ?? false
    ]);
  }

  public static function hasSlider(): bool
  {
    $settings = get_field('background-slider') ?: [];
    return isset($settings['slides']) && !empty($settings['slides']);
  }

  public static function getStylesConfig(): array
  {
    $settings = get_field('background-slider') ?: [];

    return [
      'backgroundSlider' => [
        'slides' => isset($settings['slides']) ? $settings['slides'] : [],
        'showArrows' => $settings['showArrows'] ?? false,
        'config' => [
          'autoplay' => ($settings['autoplay'] ?? true) == true ? [
            'delay' => $settings['autoplaySpeed'] ?? 5000
          ] : false,
          'loop' => boolval($settings['loop'] ?? false),
          'effect' => $settings['effect'] ?? static::getDefaultEffect(),
          'speed' => $settings['speed'] ?? 500,
        ]
      ]
    ];
  }
}