<?php

namespace Seeme\Components\Partials;

use Seeme\Components\Partials\Abstract\BasePartial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Card extends BasePartial
{
  public string $slug = 'card';

  public array $optionsClasses = [
    'variant' => [
      'primary' => 'bg-primary-400 text-primary-accent p-8 rounded-[2rem]',
      'outline' => 'bg-transparent border p-8 rounded-[2rem]',
    ]
  ];

  public function getFields(): ?FieldsBuilder
  {
    $builder = new FieldsBuilder($this->slug);

    $builder
      ->addTab('Ustawienia kafelka')
      ->addRange('cardWidth', [
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
    $classes = [];
    $settings = $this->getSettings();

    $classes = array_merge($classes, $this->getOptionsClasses());

    if(isset($settings['cardWidth'])) {
      $classes[] = "col-[--card-width]";
    }

    return $classes;
  }

  public function getStyles(): array
  {
    $styles = [];
    $settings = $this->getSettings();

    if(isset($settings['cardWidth'])) {
      $styles[] = "--card-width: span {$settings['cardWidth']}";
    }

    return $styles;
  }

  public static function getCardWidth(int $id)
  {
    $settings = get_field('card', $id);
    return $settings['cardWidth'] ?? 1;
  }
}