<?php

namespace Seeme\Components\Partials\Styles\Background;

use Seeme\Components\Partials\Abstract\StylesPartial;
use Seeme\Components\Partials\Utilities\Slider;
use StoutLogic\AcfBuilder\FieldsBuilder;

class BackgroundSlider extends StylesPartial
{
  public static $slug = 'background-slider';
  public static $parentSlug = 'background';

  public static function getFields(): ?FieldsBuilder
  {
    $builder = new FieldsBuilder(static::$slug);

    $builder
        ->addGallery('slides', [
          'label' => 'Slajdy'
        ])
        ->addFields(Slider::fields());
        
    return $builder;
  }

  public static function hasSlider(): bool
  {
    $settings = static::getSettings();

    return isset($settings['slides']) && is_array($settings['slides']) && !empty($settings['slides']);
  }

  public static function getClasses(): array
  {
    $settings = static::getSettings();
    $classes = [];

    $classes = array_merge($classes, static::getOptionsClasses());

    if(static::hasSlider()) {
      $classes = array_merge($classes, Slider::getClasses(static::$parentSlug, static::$slug));
    }

    return $classes;
  }

  public static function getVariables(): array
  {
    $settings = static::getSettings();

    return [
      'slides' => $settings['slides'] ?? [],
      ...Slider::getVariables(static::$parentSlug, static::$slug)
    ];
  }
}