<?php

namespace Seeme\Components\Partials;

use Seeme\Components\Partials\Abstract\BasePartial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Position extends BasePartial
{
  public array $attributes = [
    'title' => 'Pozycja'
  ];
  
  public string $slug = 'position';

  public array $options = [
    'position' => [
      'label' => 'Pozycja',
      'choices' => [
        'static' => 'Statyczna',
        'sticky' => 'Sticky',
      ],
      'default_value' => 'static'
    ]
  ];

  public array $optionsClasses = [
    'position' => [
      'static' => '',
      'sticky' => 'sticky'
    ]
  ];

  public function getFields(): ?FieldsBuilder
  {
    $builder = new FieldsBuilder($this->slug);

    $builder
      ->addNumber('top', [
        'label' => 'Top',
        'step' => 1,
        'append' => 'px',
        'wrapper' => [
          'width' => '50%'
        ],
        'conditional_logic' => [
          [
            [
              'field' => 'position',
              'operator' => '==',
              'value' => 'sticky'
            ]
          ]
        ]
      ])
      ->addNumber('bottom', [
        'label' => 'Bottom',
        'step' => 1,
        'append' => 'px',
        'wrapper' => [
          'width' => '50%'
        ],
        'conditional_logic' => [
          [
            [
              'field' => 'position',
              'operator' => '==',
              'value' => 'sticky'
            ]
          ]
        ]
      ])
      ->addNumber('left', [
        'label' => 'Left',
        'step' => 1,
        'append' => 'px',
        'wrapper' => [
          'width' => '50%'
        ],
        'conditional_logic' => [
          [
            [
              'field' => 'position',
              'operator' => '==',
              'value' => 'sticky'
            ]
          ]
        ]
      ])
      ->addNumber('right', [
        'label' => 'Right',
        'step' => 1,
        'append' => 'px',
        'wrapper' => [
          'width' => '50%'
        ],
        'conditional_logic' => [
          [
            [
              'field' => 'position',
              'operator' => '==',
              'value' => 'sticky'
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

    if(isset($settings['top']) && $settings['top'] !== "") {
      $classes[] = "top-[--position-top]";
    }

    if(isset($settings['bottom']) && $settings['bottom'] !== "") {
      $classes[] = "bottom-[--position-bottom]";
    }

    if(isset($settings['left']) && $settings['left'] !== "") {
      $classes[] = "left-[--position-left]";
    }

    if(isset($settings['right']) && $settings['right'] !== "") {
      $classes[] = "right-[--position-right]";
    }

    return $classes;
  }

  public function getStyles(): array
  {
    $settings = $this->getSettings();
    $styles = [];

    if(isset($settings['top']) && $settings['top'] !== "") {
      $styles[] = "--position-top: {$settings['top']}px";
    }

    if(isset($settings['bottom']) && $settings['bottom'] !== "") {
      $styles[] = "--position-bottom: {$settings['bottom']}px";
    }

    if(isset($settings['left']) && $settings['left'] !== "") {
      $styles[] = "--position-left: {$settings['left']}px";
    }

    if(isset($settings['right']) && $settings['right'] !== "") {
      $styles[] = "--position-right: {$settings['right']}px";
    }

    return $styles;
  } 
}