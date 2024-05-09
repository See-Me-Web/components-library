<?php

namespace Seeme\Components\Partials;

use Seeme\Components\Partials\Abstract\BasePartial;
use Seeme\Components\Partials\Background\BackgroundColor;
use Seeme\Components\Partials\Background\BackgroundImage;
use Seeme\Components\Partials\Background\BackgroundOverlay;
use Seeme\Components\Partials\Background\BackgroundSlider;
use Seeme\Components\Partials\Background\BackgroundVideo;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Background extends BasePartial
{
  public array $attributes = [
    'title' => 'Tło'
  ];

  public string $slug = 'background';
  public array $partials = [];

  public function __construct(array $attributes = [])
  {
    $childAtts = [...$attributes, 'parents' => [...$attributes['parents'] ?? [], $this->slug]];
    
    $this->partials = [
      'backgroundColor' => new BackgroundColor($childAtts),
      'backgroundImage' => new BackgroundImage($childAtts),
      'backgroundOverlay' => new BackgroundOverlay($childAtts),
      'backgroundSlider' => new BackgroundSlider($childAtts),
      'backgroundVideo' => new BackgroundVideo($childAtts)
    ];

    parent::__construct($attributes);
  }

  public array $options = [
    'mode' => [
      'label' => 'Tryb',
      'choices' => [
        'none' => 'Brak',
        'color' => 'Kolor',
        'image' => 'Obraz',
        'video' => 'Wideo',
        'slider' => 'Slajder'
      ],
      'default_value' => 'none'
    ]
  ];

  public function getFields(): ?FieldsBuilder
  {
    $builder = new FieldsBuilder($this->slug);

    $builder
      ->addFields($this->partials['backgroundColor']->fields([
        'label' => '',
        'conditional_logic' => [
          [
            [
              'field' => 'mode',
              'operator' => '==',
              'value' => 'color'
            ]
          ]
        ]
    ]))
    ->addFields($this->partials['backgroundImage']->fields([
      'label' => '',
      'conditional_logic' => [
        [
          [
            'field' => 'mode',
            'operator' => '==',
            'value' => 'image'
          ]
        ]
      ]
    ]))
    ->addFields($this->partials['backgroundSlider']->fields([
      'label' => '',
      'conditional_logic' => [
        [
          [
            'field' => 'mode',
            'operator' => '==',
            'value' => 'slider'
          ]
        ]
      ]
    ]))
    ->addFields($this->partials['backgroundVideo']->fields([
      'label' => '',
      'conditional_logic' => [
        [
          [
            'field' => 'mode',
            'operator' => '==',
            'value' => 'video'
          ]
        ]
      ]
    ]))
    ->addFields($this->partials['backgroundOverlay']->fields([
      'label' => '',
      'conditional_logic' => [
        [
          [
            'field' => 'mode',
            'operator' => '!=',
            'value' => 'none'
          ],
          [
            'field' => 'mode',
            'operator' => '!=',
            'value' => 'color'
          ]
        ]
      ]
    ]));

    return $builder;
  }

  public function getClasses(): array
  {
    $settings = $this->getSettings();
    $classes = [];
    $mode = $settings['mode'] ?? 'none';

    $classes = array_merge($classes, $this->getOptionsClasses());

    if($this->partials['backgroundOverlay']->hasOverlay()) {
      $classes = array_merge($classes, $this->partials['backgroundOverlay']->getClasses());
    }

    if($mode === 'color') {
      $classes = array_merge($classes, $this->partials['backgroundColor']->getClasses());
    }

    if($mode === 'image') {
      $classes = array_merge($classes, $this->partials['backgroundImage']->getClasses());
    }

    if($mode === 'video') {
      $classes = array_merge($classes, $this->partials['backgroundVideo']->getClasses());
    }

    if($mode === 'slider') {
      $classes = array_merge($classes, $this->partials['backgroundSlider']->getClasses());
    }

    return $classes;
  }

  public function getStyles(): array
  {
    $settings = $this->getSettings();
    $mode = $settings['mode'] ?? 'none';
    $styles = [];

    if($this->partials['backgroundOverlay']->hasOverlay()) {
      $styles = array_merge($styles, $this->partials['backgroundOverlay']->getStyles());
    }

    if($mode === 'color') {
      $styles = array_merge($styles, $this->partials['backgroundColor']->getStyles());
    }

    if($mode === 'image') {
      $styles = array_merge($styles, $this->partials['backgroundImage']->getStyles());
    }

    if($mode === 'video') {
      $styles = array_merge($styles, $this->partials['backgroundVideo']->getStyles());
    }

    if($mode === 'slider') {
      $styles = array_merge($styles, $this->partials['backgroundSlider']->getStyles());
    }

    return $styles;
  }

  public function getVariables(): array
  {
    $settings = $this->getSettings();
    $mode = $settings['mode'] ?? 'none';

    return [
      'background' => [
        'hasOverlay' => $this->partials['backgroundOverlay']->hasOverlay(),
        'hasVideo' => $this->partials['backgroundVideo']->hasVideo() && $mode === 'video',
        'hasSlider' => $this->partials['backgroundSlider']->hasSlider() && $mode === 'slider',
        'backgroundVideo' => $this->partials['backgroundVideo']->getVariables(),
        'backgroundSlider' => $this->partials['backgroundSlider']->getVariables()
      ]
    ];
  }
}