<?php

namespace Seeme\Components\Partials\Background;

use Seeme\Components\Partials\Abstract\BasePartial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class BackgroundColor extends BasePartial
{
  public string $slug = 'background-color';

  public function getFields(): ?FieldsBuilder
  {
    $builder = new FieldsBuilder($this->slug);

    $builder
      ->addField('background-color', 'editor_palette', [
        'label' => 'Kolor tła',
        'return_format' => 'color'
      ])
      ->addColorPicker('custom-background-color', [
        'label' => 'Własny kolor tła'
      ]);

    return $builder;
  }

  public function getClasses(): array
  {
    $settings = $this->getSettings();
    $classes = [];

    $classes = array_merge($classes, $this->getOptionsClasses());

    if(isset($settings['background-color']) || isset($settings['custom-background-color'])) {
      $classes[] = "bg-[color:--bg-color]";
    }

    return $classes;
  }

  public function getStyles(): array
  {
    $settings = $this->getSettings();
    $styles = [];
    $bgColor = $settings['custom-background-color'] ?? "";

    if(empty($bgColor)) {
      $bgColor = $settings['background-color'] ?? "";
    }

    if(!empty($bgColor)) {
      $styles[] = "--bg-color: {$bgColor}";
    }

    return $styles;
  } 
}