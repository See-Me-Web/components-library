<?php

namespace Seeme\Components\Partials;

use Seeme\Components\Partials\Abstract\BasePartial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Card extends BasePartial
{
  public string $slug = 'card';
  public array $partials = [];

  public array $options = [
    'variant' => [
      'label' => 'Wariant',
      'choices' => [
        'primary' => 'Primary',
        'outline' => 'Outline',
        'custom' => 'Własny styl'
      ],
      'default_value' => 'primary'
    ]
  ];

  public array $optionsClasses = [
    'variant' => [
      'primary' => 'bg-primary-400 text-primary-accent p-8 rounded-[2rem]',
      'outline' => 'bg-transparent border p-8 rounded-[2rem]',
    ]
  ];

  public function __construct(array $attributes = [])
  {
    $childAtts = [...$attributes, 'parents' => [$this->slug]];

    $this->partials = [
      'background' => new Background($childAtts),
      'border' => new Border($childAtts),
      'shadow' => new Shadow($childAtts),
    ];

    parent::__construct($attributes);
  }

  public function getFields(): ?FieldsBuilder
  {
    $builder = new FieldsBuilder($this->slug);

    $builder
      ->addFields($this->partials['background']->fields(['label' => '']))
      ->addFields($this->partials['border']->fields(['label' => '']))
      ->addFields($this->partials['shadow']->fields(['label' => '']))
      ->addTab('Ustawienia kafelka')
      ->addRange('card-width', [
        'label' => 'Szerokość kafelka',
        'min' => 1,
        'default_value' => 1,
        'max' => 3,
        'append' => 'kolumn(a)'
      ]);

    return $builder;
  }

  public function getClasses(): array
  {
    $settings = $this->getSettings();
    $classes = [];

    $classes = array_merge($classes, $this->getOptionsClasses());

    $classes = array_merge($classes, $this->partials['background']->getClasses());
    $classes = array_merge($classes, $this->partials['border']->getClasses());
    $classes = array_merge($classes, $this->partials['shadow']->getClasses());

    if(isset($settings['card-width']) && $settings['card-width'] == 1) {
      $classes[] = "col-span-1";
    }

    if(isset($settings['card-width']) && $settings['card-width'] == 2) {
      $classes[] = "col-span-2";
    }

    if(isset($settings['card-width']) && $settings['card-width'] == 3) {
      $classes[] = "col-span-3";
    }

    return $classes;
  }

  public function getStyles(): array
  {
    $settings = $this->getSettings();
    $styles = [];

    $styles = array_merge($styles, $this->partials['background']->getStyles());
    $styles = array_merge($styles, $this->partials['border']->getStyles());
    $styles = array_merge($styles, $this->partials['shadow']->getStyles());

    return $styles;
  }
}