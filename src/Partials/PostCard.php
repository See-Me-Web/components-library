<?php

namespace Seeme\Components\Partials;

use Seeme\Components\Partials\Abstract\BasePartial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class PostCard extends BasePartial
{
  public string $slug = 'post-card';
  public array $partials = [];

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
      ->addFields($this->partials['shadow']->fields(['label' => '']));

    return $builder;
  }

  public function getClasses(): array
  {
    $classes = [];

    $classes = array_merge($classes, $this->partials['background']->getClasses());
    $classes = array_merge($classes, $this->partials['border']->getClasses());
    $classes = array_merge($classes, $this->partials['shadow']->getClasses());

    return $classes;
  }

  public function getStyles(): array
  {
    $styles = [];

    $styles = array_merge($styles, $this->partials['background']->getStyles());
    $styles = array_merge($styles, $this->partials['border']->getStyles());
    $styles = array_merge($styles, $this->partials['shadow']->getStyles());

    return $styles;
  }
}