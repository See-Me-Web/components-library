<?php

namespace Seeme\Components\Partials\Styles;

use Seeme\Components\Partials\Abstract\StylesPartial;
use Seeme\Components\Partials\Styles\Background\BackgroundImage;
use Seeme\Components\Partials\Styles\Background\BackgroundOverlay;
use Seeme\Components\Partials\Styles\Background\BackgroundSlider;
use Seeme\Components\Partials\Styles\Background\BackgroundVideo;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Background extends StylesPartial
{
  public static $title = 'Tło';
  public static $slug = 'background';

  public static $options = [
    'mode' => [
      'label' => 'Tryb',
      'choices' => [
        'none' => 'Brak',
        'image' => 'Obraz',
        'video' => 'Wideo',
        'slider' => 'Slajder'
      ],
      'default_value' => 'none'
    ]
  ];

  public static function getFields(): ?FieldsBuilder
  {
    $builder = new FieldsBuilder(static::$slug);

    $builder
        ->addFields(BackgroundImage::fields([
          'conditional_logic' => [
            [
              [
                'field' => 'mode',
                'operator' => '==',
                'value' => 'image'
              ]
            ]
          ]
        ]))
        ->addFields(BackgroundVideo::fields([
          'conditional_logic' => [
            [
              [
                'field' => 'mode',
                'operator' => '==',
                'value' => 'video'
              ]
            ]
          ]
        ]))
        ->addFields(BackgroundSlider::fields([
          'conditional_logic' => [
            [
              [
                'field' => 'mode',
                'operator' => '==',
                'value' => 'slider'
              ]
            ]
          ]
        ]))
        ->addFields(BackgroundOverlay::fields());
        
    return $builder;
  }

  public static function getClasses(): array
  {
    $settings = static::getSettings();
    $classes = [];
    $mode = $settings['mode'] ?? static::getDefault('mode');

    $classes = array_merge($classes, static::getOptionsClasses());

    if(BackgroundOverlay::hasOverlay()) {
      $classes = array_merge($classes, BackgroundOverlay::getClasses());
    }

    if($mode === 'image') {
      $classes = array_merge($classes, BackgroundImage::getClasses());
    }

    if($mode === 'video') {
      $classes = array_merge($classes, BackgroundVideo::getClasses());
    }

    if($mode === 'slider') {
      $classes = array_merge($classes, BackgroundSlider::getClasses());
    }
    
    return $classes;
  }

  public static function getStyles(): array
  {
    $settings = static::getSettings();
    $styles = [];
    $mode = $settings['mode'] ?? static::getDefault('mode');

    if(BackgroundOverlay::hasOverlay()) {
      $styles = array_merge($styles, BackgroundOverlay::getStyles());
    }

    if($mode === 'image') {
      $styles = array_merge($styles, BackgroundImage::getStyles());
    }

    if($mode === 'video') {
      $styles = array_merge($styles, BackgroundVideo::getStyles());
    }

    if($mode === 'slider') {
      $styles = array_merge($styles, BackgroundSlider::getStyles());
    }

    return $styles;
  } 

  public static function getVariables(): array
  {
    $settings = static::getSettings();
    $mode = $settings['mode'] ?? static::getDefault('mode');

    return [
      'background' => [
        'hasOverlay' => BackgroundOverlay::hasOverlay(),
        'hasVideo' => BackgroundVideo::hasVideo() && $mode === 'video',
        'hasSlider' => BackgroundSlider::hasSlider() && $mode === 'slider',
        'backgroundVideo' => BackgroundVideo::getVariables(),
        'backgroundSlider' => BackgroundSlider::getVariables()
      ]
    ];
  }
}