<?php

namespace Seeme\Components\Partials\Styles\Background;

use Seeme\Components\Partials\Abstract\StylesPartial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class BackgroundOverlay extends StylesPartial
{
  public static $parentSlug = 'background';
  public static $slug = 'background-overlay';

  public static function getFields(): ?FieldsBuilder
  {
    $builder = new FieldsBuilder(static::$slug);

    $builder
      ->addTrueFalse('overlay', [
        'label' => 'Nakładka',
        'default_value' => false
      ])
      ->addColorPicker('overlayColor', [
        'label' => 'Kolor nakładki',
        'enable_opacity' => true,
        'conditional_logic' => [
          [
            [
              'field' => 'overlay',
              'operator' => '==',
              'value' => 1
            ]
          ]
        ]
      ]);

    return $builder;
  }

  public static function hasOverlay(): bool
  {
    $settings = static::getSettings();
    return isset($settings['overlay']) && $settings['overlay'] === true;
  }

  public static function getClasses(): array
  {
    $settings = static::getSettings();
    $classes = [];

    $classes = array_merge($classes, static::getOptionsClasses());

    if(static::hasOverlay()) {
      $classes[] = "z-10 relative overflow-hidden has-overlay";
    }

    return $classes;
  }

  public static function getStyles(): array
  {
    $settings = static::getSettings();
    $styles = [];

    if(
      isset($settings['overlay']) && boolval($settings['overlay']) === true && 
      isset($settings['overlayColor']) && !empty($settings['overlayColor'])
    ) {
      $styles[] = "--overlay-color: {$settings['overlayColor']}";
    }

    return $styles;
  } 
}