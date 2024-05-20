<?php

namespace Seeme\Components\Partials;

class ButtonIcon extends Button 
{
  public string $slug = 'button-icon';

  public array $optionsClasses = [
    'variant' => [
      'basic' => [
        'btn-basic bg-transparent',
        'rounded-full border-transparent',
        '[&.is-active]:bg-primary-400 hover:bg-primary-400 focus-visible:bg-primary-400',
        '[&.is-active]:border-primary-400 hover:border-primary-400 focus-visible:border-primary-400',
        'inline-flex items-center justify-center gap-4',
        'whitespace-nowrap transition-colors no-underline hover:no-underline',
      ],
      'primary' => [
        'btn-primary bg-primary-400',
        'rounded-full border-primary-400',
        '[&.is-active]:bg-primary-600 hover:bg-primary-600 focus-visible:bg-primary-600',
        '[&.is-active]:border-primary-600 hover:border-primary-600 focus-visible:border-primary-600',
        'inline-flex items-center justify-center gap-4',
        'whitespace-nowrap transition-colors no-underline hover:no-underline',
      ],
      'outline' => [
        'btn-outline bg-transparent',
        'rounded-full border',
        '[&.is-active]:bg-primary-400 hover:bg-primary-400 focus-visible:bg-primary-400',
        'inline-flex items-center justify-center gap-4',
        'whitespace-nowrap transition-colors no-underline hover:no-underline',
      ],
    ],
    'size' => [
      'small' => 'btn-small size-12 [&>svg]:size-4',
      'medium' => 'btn-medium size-12 [&>svg]:size-4 md:size-14 [&>svg]:md:size-6',
      'large' => 'btn-large size-14 [&>svg]:size-6 md:size-16 [&>svg]:md:size-8'
    ],
    'weight' => [
      'regular' => 'border w[&_path]:stroke-2 font-normal',
      'bold' => 'border-2 [&_path]:stroke-2 font-semibold'
    ]
  ];
}