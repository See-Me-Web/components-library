<?php

namespace Seeme\Components\Partials;

use Seeme\Components\Partials\Abstract\BasePartial;

class Text extends BasePartial
{
  public array $attributes = [
    'title' => 'Tekst'
  ];
  
  public string $slug = 'text';

  public array $options = [
    'family' => [
      'label' => 'Czcionka',
      'choices' => [
        'main' => 'Główna',
        'alt' => 'Alternatywna',
      ],
      'default_value' => 'main'
    ]
  ];

  public array $optionsClasses = [
    'family' => [
      'main' => 'font-main',
      'alt' => 'font-alt'
    ]
  ];
}