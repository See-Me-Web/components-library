<?php

namespace Seeme\Components\Partials;

use Seeme\Components\Partials\Abstract\BasePartial;

class Variant extends BasePartial
{
  public array $attributes = [
    'title' => 'Wariant'
  ];
  
  public string $slug = 'variant';

  public array $options = [
    'variant' => [
      'label' => 'Wariant',
      'choices' => [
        'primary' => 'Primary',
        'outline' => 'Outline',
      ],
      'default_value' => 'primary'
    ]
  ];

  public function getVariant(): string
  {
    $settings = $this->getSettings();

    return $settings['variant'] ?? 'primary';
  }
}