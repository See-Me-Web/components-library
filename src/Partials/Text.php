<?php

namespace Seeme\Components\Partials;

use Seeme\Components\Partials\Abstract\BasePartial;
use StoutLogic\AcfBuilder\FieldsBuilder;

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

  public function getFields(): ?FieldsBuilder
  {
    $builder = new FieldsBuilder($this->slug);

    $builder
      ->addField('text-color', 'editor_palette', [
        'label' => 'Kolor tekstu',
        'return_format' => 'color',
        'wrapper' => [
          'width' => '50%'
        ]
      ])
      ->addColorPicker('custom-text-color', [
        'instructions' => 'Ustawienie tego koloru powoduje nadpisanie koloru z palety',
        'label' => 'Własny kolor tekstu',
        'wrapper' => [
          'width' => '50%'
        ]
      ]);

    return $builder;
  }

  public function getClasses(): array
  {
    $settings = $this->getSettings();
    $classes = [];

    $classes = array_merge($classes, $this->getOptionsClasses());

    if(isset($settings['text-color']) || isset($settings['custom-text-color'])) {
      $classes[] = "text-[color:--text-color]";
    }

    return $classes;
  }

  public function getStyles(): array
  {
    $settings = $this->getSettings();
    $styles = [];
    $color = $settings['custom-text-color'] ?? "";

    if(empty($color)) {
      $color = $settings['text-color'] ?? "";
    }

    if(!empty($color)) {
      $styles[] = "--text-color: {$color}";
    }

    return $styles;
  }
}
