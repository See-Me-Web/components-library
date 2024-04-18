<?php

namespace Seeme\Components\StylesPartials;

use Illuminate\Support\Arr;
use Seeme\Components\Helpers\ArrHelper;
use Seeme\Components\StylesPartials\Abstract\BasePartial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Shadow extends BasePartial
{
  public static function getShadowPresets(): array
  {
    return apply_filters('sm/components/shadow/presets', [
      'none' => [
        'label' => 'Brak',
        'classes' => 'shadow-none'
      ],
      'sm' => [
        'label' => 'Mały',
        'classes' => 'shadow-sm',
      ],
      'regular' => [
        'label' => 'Normalny',
        'classes' => 'shadow'
      ],
      'md' => [
        'label' => 'Średni',
        'classes' => 'shadow-md'
      ],
      'lg' => [
        'label' => 'Duży',
        'classes' => 'shadow-lg'
      ],
      'xl' => [
        'label' => 'Bardzo duży',
        'classes' => 'shadow-xl'
      ]
    ]);
  }

  public static function getDefaultShadowPreset(): string
  {
    return apply_filters('sm/components/shadow/defaultPreset', 'none');
  }

  public static function getFields(): ?FieldsBuilder
  {
    $builder = new FieldsBuilder('shadow');

    $builder
      ->addGroup('shadow')
        ->addSelect('shadowPreset', [
          'label' => 'Cień',
          'choices' => static::getOptionsLabels(static::getShadowPresets()),
          'default_value' => static::getDefaultShadowPreset()
        ])
        ->addTrueFalse('customShadowColor', [
          'label' => 'Inny kolor cienia'
        ])
        ->addColorPicker('shadowColor', [
          'label' => 'Kolor cienia',
          'conditional_logic' => [
            [
              [
                'field' => 'customShadowColor',
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
    return apply_filters('sm/components/shadow/fieldsTitle', __('Cień', 'sm-components'));
  }

  public static function getClasses(): string
  {
    $settings = get_field('shadow');

    return Arr::toCssClasses([
      static::getSettingClasses(static::getShadowPresets(), $settings['shadowPreset'] ?? static::getDefaultShadowPreset()),
      'shadow-[color:--shadow-color]' => isset($settings['shadowColor']) && !empty($settings['shadowColor']) && 
                                        isset($settings['customShadowColor']) && $settings['customShadowColor'] === true
    ]);
  }

  public static function getStyle(): string
  {
    $styles = [];
    $settings = get_field('shadow');

    if(
      isset($settings['shadowColor']) && !empty($settings['shadowColor']) && 
      isset($settings['customShadowColor']) && $settings['customShadowColor'] === true
    ) {
      $styles[] = "--shadow-color: {$settings['shadowColor']}";
    }

    return ArrHelper::toCssStyles($styles);
  }
}