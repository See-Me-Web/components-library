<?php

namespace Seeme\Components\Partials;

use Seeme\Components\Partials\Abstract\BasePartial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Button extends BasePartial
{
  public array $attributes = [
    'title' => 'Przycisk'
  ];
  
  public string $slug = 'button';

  public array $options = [
    'variant' => [
      'label' => 'Wariant',
      'choices' => [
        'primary' => 'Primary',
        'secondary' => 'Secondary'
      ],
      'default_value' => 'primary'
    ],
    'size' => [
      'label'=> 'Wielkość',
      'choices' => [
        'small' => 'Mały',
        'medium' => 'Średni',
        'large' => 'Duży'
      ],
      'default_value' => 'medium'
    ]
  ];

  public array $optionsClasses = [
    'variant' => [
      'primary' => [
        'btn-primary inline-flex items-center justify-center gap-4',
        'border bg-trasparent border-primary text-primary',
        'text-base whitespace-nowrap transition-colors',
        'rounded-full no-underline hover:no-underline'
      ],
      'secondary' => [
        'btn-secondary inline-flex items-center justify-center gap-4',
        'outline outline-1 bg-trasparent outline-primary text-primary',
        'text-base whitespace-nowrap transition-colors',
        'rounded-full no-underline hover:no-underline'
      ]
    ],
    'size' => [
      'small' => 'btn-small p-4 text-sm',
      'medium' => 'btn-medium p-6 text-sm md:text-base',
      'large' => 'btn-large p-8 text-base md:text-lg'
    ]
  ];

  public function getFields(): ?FieldsBuilder
  {
    $builder = new FieldsBuilder($this->slug);

    $builder
      ->addLink('link')
      ->addImage('iconLeft', [
        'label' => 'Icon before text',
      ])
      ->addImage('iconRight', [
        'label' => 'Icon after text',
      ]);

    return $builder;
  }

  public function getClasses(): array
  {
    return $this->getOptionsClasses();
  }

  public function getVariables(): array
  {
    return $this->getSettings();
  }
}