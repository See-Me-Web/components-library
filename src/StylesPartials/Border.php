<?php

namespace Seeme\Components\StylesPartials;

use Illuminate\Support\Arr;
use Seeme\Components\Helpers\ArrHelper;
use Seeme\Components\StylesPartials\Abstract\BasePartial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Border extends BasePartial
{
  public static function getRadiusPresets(): array
  {
    return apply_filters('sm/components/border/radiusPresets', [
      'none' => [
        'label' => 'Brak',
        'classes' => 'rounded-none'
      ],
      'full' => [
        'label' => 'Pełne',
        'classes' => 'rounded-full'
      ]
    ]);
  }

  public static function getDefaultRadiusPreset(): string
  {
    return apply_filters('sm/components/border/defaultRadiusPreset', 'none');
  }

  public static function getFields(): ?FieldsBuilder
  {
    $builder = new FieldsBuilder('border');

    $builder
      ->addGroup('border')
      ->addSelect('radiusPreset', [
        'label' => 'Zaokrąglenie ramki',
        'choices' => [
          ...static::getOptionsLabels(static::getRadiusPresets()),
          'custom' => 'Inne'
        ],
        'default_value' => static::getDefaultRadiusPreset()
      ])
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

  public static function getFieldsTitle(): string
  {
    return apply_filters('sm/components/border/fieldsTitle', __('Ramka', 'sm-components'));
  }

  public static function getClasses(): string
  {
    $settings = get_field('border');

    return Arr::toCssClasses([
      static::getSettingClasses(static::getRadiusPresets(), $settings['radiusPreset'] ?? static::getDefaultRadiusPreset()),
      'rounded-[--border-radius]' => isset($settings['radius']) && isset($settings['radiusPreset']) && $settings['radiusPreset'] === 'custom',
      'border-[--border-color]' => isset($settings['color']) && !empty($settings['color']),
      'border-[length:--border-width]' => isset($settings['width']) && !empty($settings['width'])
    ]);
  }

  public static function getStyle(): string
  {
    $styles = [];
    $settings = get_field('border');

    if(isset($settings['radius']) && isset($settings['radiusPreset']) && $settings['radiusPreset'] === 'custom') {
      $styles[] = "--border-radius: {$settings['radius']}rem";
    }

    if(isset($settings['color']) && !empty($settings['color'])) {
      $styles[] = "--border-color: {$settings['color']}";
    }

    if(isset($settings['width']) && !empty($settings['width'])) {
      $styles[] = "--border-width: {$settings['width']}px";
    }

    return ArrHelper::toCssStyles($styles);
  }
}