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
        'basic' => 'Basic',
        'primary' => 'Primary',
        'outline' => 'Outline'
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
    ],
    'weight' => [
      'label' => 'Grubość',
      'choices' => [
        'regular' => 'Normalna',
        'bold' => 'Pogrubiony'
      ],
      'default_value' => 'regular'
    ],
    'rounded' => [
      'label' => 'Zaokrąglenie',
      'choices' => [
        'none' => 'Brak',
        'sm' => 'Małe',
        'lg' => 'Duże',
        'full' => 'Pełne'
      ],
      'default_value' => 'full'
    ]
  ];


  public array $optionsClasses = [
    'variant' => [
      'basic' => [
        'btn-basic bg-transparent',
        'border-transparent',
        '[&.is-active]:bg-primary-400 hover:bg-primary-400 focus-visible:bg-primary-400',
        '[&.is-active]:border-primary-400 hover:border-primary-400 focus-visible:border-primary-400',
        'inline-flex items-center justify-center gap-4',
        'whitespace-nowrap transition-colors !no-underline !hover:no-underline',
      ],
      'primary' => [
        'btn-primary bg-primary-400 text-primary-accent',
        'border-primary-400',
        '[&.is-active]:bg-primary-600 hover:bg-primary-600 focus-visible:bg-primary-600',
        '[&.is-active]:border-primary-600 hover:border-primary-600 focus-visible:border-primary-600',
        '[&_svg]:fill-primary-50',
        'inline-flex items-center justify-center gap-4',
        'whitespace-nowrap transition-colors !no-underline !hover:no-underline',
      ],
      'outline' => [
        'btn-outline bg-transparent',
        'border',
        '[&.is-active]:bg-primary-400 hover:bg-primary-400 focus-visible:bg-primary-400',
        'inline-flex items-center justify-center gap-4',
        'whitespace-nowrap transition-colors !no-underline !hover:no-underline',
      ],
    ],
    'size' => [
      'small' => 'btn-small p-4 text-sm',
      'medium' => 'btn-medium p-6 text-sm md:text-base',
      'large' => 'btn-large p-8 text-base md:text-lg'
    ],
    'weight' => [
      'regular' => 'border w[&_path]:stroke-2 font-normal',
      'bold' => 'border-2 [&_path]:stroke-2 font-semibold'
    ],
    'rounded' => [
      'none' => 'rounded-none',
      'sm' => 'rounded-md',
      'lg' => 'rounded-2xl',
      'full' => 'rounded-full'
    ]
  ];

  public function getFields(): ?FieldsBuilder
  {
    $builder = new FieldsBuilder($this->slug);

    $builder
      ->addLink('link');

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