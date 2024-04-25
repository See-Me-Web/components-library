<?php

namespace Seeme\Components\Blocks\Abstract;

abstract class ComponentBlock extends BaseBlock 
{
  public $component_partial = null;

  public function getStylesFields()
  {
    if(! $this->component_partial) {
      return parent::getStylesFields();
    }

    $builder = parent::getStylesFields();

    $builder->addFields($this->component_partial::fields());

    return $builder;
  }

  public function with()
  {
    if(! $this->component_partial) {
      return parent::with();
    }

    return [
      ...parent::with(),
      ...$this->component_partial::getVariables()
    ];
  }
}