<?php

namespace Seeme\Components\View\Components;

use Illuminate\Support\Arr;
use Seeme\Components\Partials\Heading as PartialsHeading;
use Seeme\Components\View\Components\Abstract\BaseComponent;

class Heading extends BaseComponent
{
    protected string $name = 'heading';
    protected $size = 'md';
    protected $element = 'h3';
    protected $weight = 'normal';
    protected $partial = null;

    public function __construct(string $size = 'md', string $element = 'h3', string $weight = 'normal')
    {
      $this->size = $size;
      $this->element = $element;
      $this->weight = $weight;
      $this->partial = new PartialsHeading([
        'args' => [
          'size' => $size,
          'weight' => $weight,
          'element' => $element
        ]
      ]);
    }

    public function with(): array
    {
        return [
          'classes' => Arr::toCssClasses($this->partial->getClasses())
        ];
    }
}