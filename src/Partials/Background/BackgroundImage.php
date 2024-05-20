<?php

namespace Seeme\Components\Partials\Background;

use Seeme\Components\Partials\Abstract\BasePartial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class BackgroundImage extends BasePartial
{
  public string $slug = 'background-image';

  public array $options = [
    'size' => [
      'label' => 'Rozmiar',
      'choices' => [
        'cover' => 'Pokryj',
        'contain' => 'Dopasuj',
        'auto' => 'Auto'
      ],
      'default_value' => 'cover'
    ],
    'position' => [
      'label' => 'Pozycja',
      'choices' => [
        'left' => 'Lewo',
        'left-top' => 'Lewo Góra',
        'left-bottom' => 'Lewo Dół',
        'center' => 'Środek',
        'center-top' => 'Środek Góra',
        'center-bottom' => 'Środek Dół',
        'right' => 'Prawo',
        'right-top' => 'Prawo Góra',
        'right-bottom' => 'Prawo Dół'
      ],
      'default_value' => 'center'
    ],
    'repeat' => [
      'label' => 'Powtarzanie',
      'choices' => [
        'repeat' => 'Powtarzaj',
        'no-repeat' => 'Nie powtarzaj',
        'repeat-x' => 'Powtarzaj w osi X',
        'repeat-y' => 'Powtarzaj w osi Y'
      ],
      'default_value' => 'no-repeat'
    ]
  ];

  public array $optionsClasses = [
    'size' => [
      'cover' => 'bg-cover',
      'contain' => 'bg-contain',
      'auto' => 'bg-auto'
    ],
    'position' => [
      'left' => 'bg-left',
      'left-top' => 'bg-left-top',
      'left-bottom' => 'bg-left-bottom',
      'center' => 'bg-center',
      'center-top' => 'bg-center-top',
      'center-bottom' => 'bg-center-bottom',
      'right' => 'bg-right',
      'right-top' => 'bg-right-top',
      'right-bottom' => 'bg-right-bottom'
    ],
    'repeat' => [
      'repeat' => 'bg-repeat',
      'no-repeat' => 'bg-no-repeat',
      'repeat-x' => 'bg-repeat-x',
      'repeat-y' => 'bg-repeat-y'
    ]
  ];

  public function getFields(): ?FieldsBuilder
  {
    $builder = new FieldsBuilder($this->slug);

    $builder
        ->addImage('desktopImage', [
          'label' => 'Obraz tła (desktop)',
          'wrapper' => [
            'width' => '50%'
          ]
        ])
        ->addImage('mobileImage', [
          'label' => 'Obraz tła (mobile)',
          'wrapper' => [
            'width' => '50%'
          ]
        ])
        ->addTrueFalse('fixed', [
          'label' => 'Podążające tło',
          'default_value' => false
        ]);

    return $builder;
  }

  public function getClasses(): array
  {
    $settings = $this->getSettings();
    $classes = [];

    $classes = array_merge($classes, $this->getOptionsClasses());

    if(isset($settings['desktopImage']) && is_array($settings['desktopImage'])) {
      $classes[] = "md:bg-image-desktop";
    }

    if(isset($settings['mobileImage']) && is_array($settings['mobileImage'])) {
      $classes[] = "bg-image-mobile";
    }

    if(isset($settings['fixed']) && $settings['fixed']) {
      $classes[] = "bg-fixed";
    }

    return $classes;
  }

  public function getStyles(): array
  {
    $settings = $this->getSettings();
    $styles = [];

    if(isset($settings['desktopImage']) && is_array($settings['desktopImage'])) {
      $styles[] = "--image-desktop: url({$settings['desktopImage']['sizes']['large']})";
    } else {
      $styles[] = "--image-desktop: none";
    }

    if(isset($settings['mobileImage']) && is_array($settings['mobileImage'])) {
      $styles[] = "--image-mobile: url({$settings['mobileImage']['sizes']['medium_large']})";
    } else {
      $styles[] = "--image-mobile: none";
    }

    return $styles;
  } 
}