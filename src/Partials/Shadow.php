<?php

namespace Seeme\Components\Partials;

use Seeme\Components\Partials\Abstract\BasePartial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Shadow extends BasePartial
{
  public array $attributes = [
    'title' => 'Cień'
  ];
  
  public string $slug = 'shadow';

  public array $options = [
    'shadowPreset' => [
      'label' => 'Cień',
      'choices' => [
        'none' => 'Brak',
        'sm' => 'Mały',
        'regular' => 'Domyślny',
        'md' => 'Średni',
        'lg' => 'Duży',
        'xl' => 'Bardzo duży'
      ],
      'default_value' => 'none'
    ]
  ];

  public array $optionsClasses = [
    'shadowPreset' => [
      'none' => 'shadow-none',
      'sm' => 'shadow-sm',
      'regular' => 'shadow',
      'md' => 'shadow-md',
      'lg' => 'shadow-lg',
      'xl' => 'shadow-xl'
    ]
  ];

  public function getFields(): ?FieldsBuilder
  {
    $builder = new FieldsBuilder($this->slug);

    $builder
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

  public function getClasses(): array
  {
    $settings = $this->getSettings();
    $classes = [];

    $classes = array_merge($classes, $this->getOptionsClasses());

    if(
      isset($settings['shadowColor']) && !empty($settings['shadowColor']) && 
      isset($settings['customShadowColor']) && $settings['customShadowColor'] === true
    ) {
      $classes[] = "shadow-[color:--shadow-color]";
    } 

    return $classes;
  }

  public function getStyles(): array
  {
    $settings = $this->getSettings();
    $styles = [];

    if(
      isset($settings['shadowColor']) && !empty($settings['shadowColor']) && 
      isset($settings['customShadowColor']) && $settings['customShadowColor'] === true
    ) {
      $styles[] = "--shadow-color: {$settings['shadowColor']}";
    }

    return $styles;
  }
}