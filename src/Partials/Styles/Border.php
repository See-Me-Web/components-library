<?php

namespace Seeme\Components\Partials\Styles;

use Seeme\Components\Partials\Abstract\StylesPartial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Border extends StylesPartial
{
  public static $title = 'Ramka';
  public static $slug = 'border';

  public static $options = [
    'radiusPreset' => [
      'label' => 'Zaokrąglenie ramki',
      'choices' => [
        'none' => 'Brak',
        'full' => 'Pełne',
        'custom' => 'Inne'
      ],
      'default_value' => 'none'
    ]
  ];

  public static $optionsClasses = [
    'radiusPreset' => [
      'none' => 'rounded-none',
      'full' => 'rounded-full',
    ]
  ];

  public static function getFields(): ?FieldsBuilder
  {
    $builder = new FieldsBuilder(static::$slug);

    $builder
      ->addRange('radius', [
        'label' => 'Zaokrąglenie',
        'step' => '0.5',
        'min' => 0.5,
        'max' => 10,
        'append' => 'rem',
        'default_value' => '2',
        'conditional_logic' => [
          [
            [
              'field' => 'radiusPreset',
              'operator' => '==',
              'value' => 'custom'
            ]
          ]
        ]
      ])
      ->addColorPicker('color', [
        'label' => 'Kolor ramki'
      ])
      ->addRange('width', [
        'label' => 'Grubość ramki',
        'step' => 1,
        'min' => 0,
        'append' => 'px',
        'default_value' => '0'
      ]);

    return $builder;
  }

  public static function getClasses(): array
  {
    $settings = static::getSettings();
    $classes = [];

    $classes = array_merge($classes, static::getOptionsClasses());

    if(isset($settings['radius']) && isset($settings['radiusPreset']) && $settings['radiusPreset'] === 'custom') {
      $classes[] = "rounded-[--border-radius]";
    }

    if(isset($settings['color']) && !empty($settings['color'])) {
      $classes[] = "border-[--border-color]";
    }

    if(isset($settings['width']) && !empty($settings['width'])) {
      $classes[] = "border-[length:--border-width]";
    }

    return $classes;
  }

  public static function getStyles(): array
  {
    $settings = static::getSettings();
    $styles = [];

    if(isset($settings['radius']) && isset($settings['radiusPreset']) && $settings['radiusPreset'] === 'custom') {
      $styles[] = "--border-radius: {$settings['radius']}rem";
    }

    if(isset($settings['color']) && !empty($settings['color'])) {
      $styles[] = "--border-color: {$settings['color']}";
    }

    if(isset($settings['width']) && !empty($settings['width'])) {
      $styles[] = "--border-width: {$settings['width']}px";
    }

    return $styles;
  }
}