<?php

namespace Seeme\Components\StylesPartials;

use Illuminate\Support\Arr;
use Seeme\Components\Helpers\ArrHelper;
use Seeme\Components\StylesPartials\Abstract\BasePartial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Background extends BasePartial
{

  public static function getModes(): array
  {
    return apply_filters('sm/components/background/modes', [
      'none' => 'Brak',
      'image' => 'Obraz',
      'video' => 'Video',
      'slider' => 'Slajder'
    ]);
  }

  public static function getDefaultMode(): string
  {
    return apply_filters('sm/components/background/defaultMode', 'image');
  }

  public static function getFields(): ?FieldsBuilder
  {
    $builder = new FieldsBuilder('background');

    $builder
        ->addSelect('mode', [
          'label' => 'Tryb',
          'choices' => static::getModes(),
          'default_value' => static::getDefaultMode()
        ])
        ->addFields(BackgroundImage::getFields())
        ->addFields(BackgroundVideo::getFields())
        ->addFields(BackgroundSlider::getFields())
        ->addGroup('background')
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

  public static function getFieldsTitle(): string
  {
    return apply_filters('sm/components/background/fieldsTitle', __('Tło', 'sm-components'));
  }

  public static function getMode(): string
  {
    return get_field('mode') ?: static::getDefaultMode();
  }

  public static function hasOverlay(): bool
  {
    $settings = get_field('background');
    return boolval($settings['overlay'] ?? false) && 
           isset($settings['overlayColor']) && 
           !empty($settings['overlayColor']);
  }

  public static function getClasses(): string
  {
    $mode = static::getMode();
    $hasOverlay = static::hasOverlay();

    return Arr::toCssClasses([
      BackgroundImage::getClasses() => $mode === 'image',
      BackgroundVideo::getClasses() => $mode === 'video',
      BackgroundSlider::getClasses() => $mode === 'slider',
      'relative z-10 overflow-hidden' => BackgroundSlider::hasSlider() || BackgroundVideo::hasVideo() || $hasOverlay,
      'has-overlay' => $hasOverlay
    ]);
  }

  public static function getStyle(): string
  {
    $styles = [];
    $settings = get_field('background');
    $mode = static::getMode();

    if($mode === 'image') {
      $styles[] = BackgroundImage::getStyle();
    }

    if($mode === 'video') {
      $styles[] = BackgroundVideo::getStyle();
    }

    if($mode === 'slider') {
      $styles[] = BackgroundSlider::getStyle();
    }

    if(
      isset($settings['overlay']) && boolval($settings['overlay']) === true && 
      isset($settings['overlayColor']) && !empty($settings['overlayColor'])
    ) {
      $styles[] = "--overlay-color: {$settings['overlayColor']}";
    }

    return ArrHelper::toCssStyles($styles);
  } 

  public static function getStylesConfig(): array
  {
    return [
      'background' => [
        'hasOverlay' => static::hasOverlay(),
        'hasVideo' => BackgroundVideo::hasVideo(),
        'hasSlider' => BackgroundSlider::hasSlider(),
        ...BackgroundVideo::getStylesConfig(),
        ...BackgroundSlider::getStylesConfig()
      ]
    ];
  }
}