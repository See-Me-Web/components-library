<?php

namespace Seeme\Components\Partials\Background;

use Seeme\Components\Partials\Abstract\BasePartial;
use Seeme\Components\Partials\Slider;
use StoutLogic\AcfBuilder\FieldsBuilder;

class BackgroundSlider extends BasePartial
{
  public string $slug = 'background-slider';
  public array $partials = [];

  public function __construct(array $attributes = [])
  {
    $childAtts = [...$attributes, 'parents' => [$this->slug]];

    $this->partials = [
      'slider' => new Slider($childAtts),
    ];

    parent::__construct($attributes);
  }

  public function getFields(): ?FieldsBuilder
  {
    $builder = new FieldsBuilder($this->slug);

    $builder
        ->addGallery('slides', [
          'label' => 'Slajdy'
        ])
        ->addFields($this->partials['slider']->fields());
        
    return $builder;
  }

  public function hasSlider(): bool
  {
    $settings = $this->getSettings();

    return isset($settings['slides']) && is_array($settings['slides']) && !empty($settings['slides']);
  }

  public function getClasses(): array
  {
    $settings = $this->getSettings();
    $classes = [];

    $classes = array_merge($classes, $this->getOptionsClasses());

    if($this->hasSlider()) {
      $classes = array_merge($classes, $this->partials['slider']->getClasses());
    }

    return $classes;
  }

  public function getVariables(): array
  {
    $settings = $this->getSettings();

    return [
      'slides' => $settings['slides'] ?? [],
      ...$this->partials['slider']->getVariables()
    ];
  }
}