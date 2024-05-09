<?php

namespace Seeme\Components\Partials;

use Seeme\Components\Partials\Abstract\BasePartial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Wrapper extends BasePartial
{
  public array $attributes = [
    'title' => 'Kontener'
  ];
  
  public string $slug = 'wrapper';

  public array $options = [
    'maxWidth' => [
      'label' => 'Maksymalna szerokość',
      'choices' => [
        'sm' => 'Mała',
        'md' => 'Średnia',
        'lg' => 'Duża',
        'xl' => 'Bardzo duża',
        '2xl' => 'Największa',
        'full' => 'Pełna',
        'custom' => 'Inna'
      ],
      'default_value' => 'md'
    ]
  ];

  public array $optionsClasses = [
    'maxWidth' => [
      'sm' => 'max-w-screen-sm',
      'md' => 'max-w-screen-md',
      'lg' => 'max-w-screen-lg',
      'xl' => 'max-w-screen-xl',
      '2xl' => 'max-w-screen-2xl',
      'full' => 'max-w-full'
    ]
  ];

  public function getFields(): ?FieldsBuilder
  {
    $builder = new FieldsBuilder($this->slug);

    $builder
      ->addRange('customMaxWidth', [
        'label' => 'Maksymalna szerokość',
        'min' => 1,
        'max' => 100,
        'step' => 1,
        'append' => 'rem',
        'conditional_logic' => [
          [
            [
              'field' => 'maxWidth',
              'operator' => '==',
              'value' => 'custom'
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

    if(isset($settings['maxWidth']) && $settings['maxWidth'] === 'custom' && isset($settings['customMaxWidth'])) {
      $classes[] = "max-w-[length:--max-width]";
    }

    return $classes;
  }

  public function getStyles(): array
  {
    $settings = $this->getSettings();
    $styles = [];

    if(isset($settings['maxWidth']) && $settings['maxWidth'] === 'custom' && isset($settings['customMaxWidth'])) {
      $styles[] = "--max-width: {$settings['customMaxWidth']}rem";
    }

    return $styles;
  }

  public function getVariables(): array
  {
    return $this->getSettings();
  }
}