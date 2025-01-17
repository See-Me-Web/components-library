<?php

namespace Seeme\Components\Partials;

use Seeme\Components\Partials\Abstract\BasePartial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Heading extends BasePartial
{
  public array $attributes = [
    'title' => 'Nagłówek'
  ];
  
  public string $slug = 'heading';

  public array $options = [
    'size' => [
      'label' => 'Rozmiar',
      'choices' => [
        'xs' => 'Bardzo mały',
        'sm' => 'Mały',
        'md' => 'Średni',
        'lg' => 'Duży',
        'xl' => 'Bardzo duży',
        'custom' => 'Inny'
      ],
      'default_value' => 'md'
    ],
    'weight' => [
      'label' => 'Grubość czcionki',
      'choices' => [
        'extralight' => 'Bardzo cienka',
        'light' => 'Cienka',
        'normal' => 'Normalna',
        'medium' => 'Średnia',
        'semibold' => 'Lekko pogrubiona',
        'bold' => 'Pogrubiona',
        'extrabold' => 'Gruba',
        'black' => 'Bardzo gruba'
      ],
      'default_value' => 'normal'
    ],
    'element' => [
      'label' => 'Element',
      'choices' => [
        'div' => 'Div',
        'h1' => 'Nagłówek H1',
        'h2' => 'Nagłówek H2',
        'h3' => 'Nagłówek H3',
        'h4' => 'Nagłówek H4',
        'h5' => 'Nagłówek H5',
        'h6' => 'Nagłówek H6',
      ],
      'default_value' => 'div'
    ]
  ];

  public array $optionsClasses = [
    'size' => [
      'xs' => 'heading-xs text-xs',
      'sm' => 'heading-sm text-sm',
      'md' => 'heading-md text-xl',
      'lg' => 'heading-lg text-2xl',
      'xl' => 'heading-xl text-4xl'
    ],
    'weight' => [
      'extralight' => 'font-extralight',
      'light' => 'font-light',
      'normal' => 'font-normal',
      'medium' => 'font-medium',
      'semibold' => 'font-semibold',
      'bold' => 'font-bold',
      'extrabold' => 'font-extrabold',
      'black' => 'font-black'
    ]
  ];

  public function getFields(): ?FieldsBuilder
  {
    $builder = new FieldsBuilder($this->slug);

    $builder
      ->addTextarea('text', [
        'label' => 'Tekst',
        'rows' => 3,
        'new_lines' => 'br'
      ])
      ->addRange('customSize', [
        'label' => 'Rozmiar',
        'min' => 0.5,
        'max' => 10,
        'step' => 0.25,
        'default_value' => 1,
        'append' => 'rem',
        'conditional_logic' => [
          [
            [
              'field' => 'size',
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

    if(isset($settings['size']) && $settings['size'] === 'custom' && isset($settings['customSize'])) {
      $classes[] = "text-[length:--heading-size]";
    }

    return $classes;
  }

  public function getStyles(): array
  {
    $settings = $this->getSettings();
    $styles = [];

    if(isset($settings['size']) && $settings['size'] === 'custom' && isset($settings['customSize'])) {
      $styles[] = "--heading-size: {$settings['customSize']}rem";
    }

    return $styles;
  }

  public function getVariables(): array
  {
    return $this->getSettings();
  }
}