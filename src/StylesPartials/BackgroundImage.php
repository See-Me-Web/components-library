<?php

namespace Seeme\Components\StylesPartials;

use Illuminate\Support\Arr;
use Seeme\Components\Helpers\ArrHelper;
use Seeme\Components\StylesPartials\Abstract\BasePartial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class BackgroundImage extends BasePartial
{
  public static function getSizes(): array
  {
    return apply_filters('sm/components/backgroundImage/sizes', [
      'cover' => [
        'label' => 'Pokryj',
        'classes' => 'bg-cover'
      ],
      'contain' => [
        'label' => 'Dopasuj',
        'classes' => 'bg-contain',
      ],
      'auto' => [
        'label' => 'Auto',
        'classes' => 'bg-auto'
      ]
    ]);
  }

  public static function getDefaultSize(): string
  {
    return apply_filters('sm/components/backgroundImage/defaultSize', 'cover');
  }

  public static function getPositions(): array
  {
    return apply_filters('sm/components/backgroundImage/positions', [
      'left' => [
        'label' => 'Lewo',
        'classes' => 'bg-left'
      ],
      'left-bottom' => [
        'label' => 'Lewo Dół',
        'classes' => 'bg-left-bottom'
      ],
      'left-top' => [
        'label' => 'Lewo Góra',
        'classes' => 'bg-left-top'
      ],
      'bottom' => [
        'label' => 'Dół',
        'classes' => 'bg-bottom'
      ],
      'center' => [
        'label' => 'Środek',
        'classes' => 'bg-center'
      ],
      'top' => [
        'label' => 'Góra',
        'classes' => 'bg-top'
      ],
      'right' => [
        'label' => 'Prawo',
        'classes' => 'bg-right'
      ],
      'right-bottom' => [
        'label' => 'Prawo Dół',
        'classes' => 'bg-right-bottom'
      ],
      'right-top' => [
        'label' => 'Prawo Góra',
        'classes' => 'bg-right-top'
      ],
    ]);
  }

  public static function getDefaultPosition(): string
  {
    return apply_filters('sm/components/backgroundImage/defaultPosition', 'center');
  }

  public static function getRepeats(): array
  {
    return apply_filters('sm/components/backgroundImage/repeats', [
      'repeat' => [
        'label' => 'Powtarzaj',
        'classes' => 'bg-repeat'
      ],
      'no-repeat' => [
        'label' => 'Nie powtarzaj',
        'classes' => 'bg-no-repeat'
      ],
      'repeat-x' => [
        'label' => 'Powtarzaj X',
        'classes' => 'bg-repeat-x'
      ],
      'repeat-y' => [
        'label' => 'Powtarzaj Y',
        'classes' => 'bg-repeat-y'
      ]
    ]);
  }

  public static function getDefaultRepeat(): string
  {
    return apply_filters('sm/components/backgroundImage/defaultRepeat', 'no-repeat');
  }

  public static function getFields(): ?FieldsBuilder
  {
    $builder = new FieldsBuilder('background-image');

    $builder
      ->addGroup('background-image', [
        'conditional_logic' => [
          [
            [
              'field' => 'mode',
              'operator' => '==',
              'value' => 'image'
            ]
          ]
        ]
      ])
        ->addImage('desktopImage', [
          'label' => 'Obraz tła (desktop)',
        ])
        ->addImage('mobileImage', [
          'label' => 'Obraz tła (mobile)',
        ])
        ->addSelect('size', [
          'label' => 'Rozmiar tła',
          'choices' => static::getOptionsLabels(static::getSizes()),
          'default_value' => static::getDefaultSize()
        ])
        ->addSelect('position', [
          'label' => 'Pozycja tła',
          'choices' => static::getOptionsLabels(static::getPositions()),
          'default_value' => static::getDefaultPosition()
        ])
        ->addSelect('repeat', [
          'label' => 'Powtarzanie tła',
          'choices' => static::getOptionsLabels(static::getRepeats()),
          'default_value' => static::getDefaultRepeat()
        ])
        ->addTrueFalse('fixed', [
          'label' => 'Podążające tło',
          'default_value' => false
        ]);

    return $builder;
  }

  public static function getClasses(): string
  {
    $settings = get_field('background-image');

    return Arr::toCssClasses([
      'bg-image-mobile' => isset($settings['mobileImage']),
      'md:bg-image-desktop' => isset($settings['desktopImage']),
      static::getSettingClasses(static::getSizes(), $settings['size'] ?? static::getDefaultSize()),
      static::getSettingClasses(static::getPositions(), $settings['position'] ?? static::getDefaultPosition()),
      static::getSettingClasses(static::getRepeats(), $settings['repeat'] ?? static::getDefaultRepeat()),
      'bg-fixed' => boolval($settings['fixed'] ?? false),
    ]);
  }

  public static function getStyle(): string
  {
    $styles = [];
    $settings = get_field('background-image') ?: [];

    if(isset($settings['desktopImage']) && is_array($settings['desktopImage'])) {
      $styles[] = "--image-desktop: url({$settings['desktopImage']['sizes']['large']})";
    } else {
      $styles[] = "--image-desktop: none";
    }

    if(isset($settings['mobileImage']) && is_array($settings['mobileImage'])) {
      $styles[] = "--image-mobile: url({$settings['mobileImage']['sizes']['medium_large']})";
    } else {
      $styles[] = "--image-mobile: none";
    }

    return ArrHelper::toCssStyles($styles);
  } 
}