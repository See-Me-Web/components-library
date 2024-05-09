<?php

namespace Seeme\Components\Partials\Background;

use Seeme\Components\Partials\Abstract\BasePartial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class BackgroundOverlay extends BasePartial
{
  public string $slug = 'background-overlay';

  public function getFields(): ?FieldsBuilder
  {
    $builder = new FieldsBuilder($this->slug);

    $builder
      ->addTrueFalse('overlay', [
        'label' => 'Nakładka',
        'default_value' => false
      ])
      ->addColorPicker('overlayColor', [
        'label' => 'Kolor nakładki',
        'enable_opacity' => true,
        'conditional_logic' => [
          [
            [
              'field' => 'overlay',
              'operator' => '==',
              'value' => 1
            ]
          ]
        ]
      ]);

    return $builder;
  }

  public function hasOverlay(): bool
  {
    $settings = $this->getSettings();
    return isset($settings['overlay']) && $settings['overlay'] === true;
  }

  public function getClasses(): array
  {
    $settings = $this->getSettings();
    $classes = [];

    $classes = array_merge($classes, $this->getOptionsClasses());

    if($this->hasOverlay()) {
      $classes[] = "z-10 relative overflow-hidden has-overlay";
    }

    return $classes;
  }

  public function getStyles(): array
  {
    $settings = $this->getSettings();
    $styles = [];

    if(
      isset($settings['overlay']) && boolval($settings['overlay']) === true && 
      isset($settings['overlayColor']) && !empty($settings['overlayColor'])
    ) {
      $styles[] = "--overlay-color: {$settings['overlayColor']}";
    }

    return $styles;
  } 
}