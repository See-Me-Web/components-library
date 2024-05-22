<?php

namespace Seeme\Components\View\Components;

use Illuminate\Support\Arr;
use Seeme\Components\Helpers\ArrHelper;
use Seeme\Components\Partials\Card as PartialsCard;
use Seeme\Components\View\Components\Abstract\BaseComponent;

class Card extends BaseComponent
{
    protected string $name = 'card';
    protected string $variant = 'primary';
    protected string $width = '1';
    protected $partial = null;

    public function __construct(string $variant = 'primary', string $width = '1')
    {
      $this->variant = $variant;
      $this->width = $width;

      $attributes = [
        'args' => [
          'variant' => $variant,
          'cardWidth' => $width
        ]
      ];

      $this->partial = new PartialsCard($attributes);
    }

    public function with(): array
    {
        return [
          'classes' => Arr::toCssClasses($this->partial->getClasses()),
          'styles' => ArrHelper::toCssStyles($this->partial->getStyles()),
          'cardWidth' => $this->width
        ];
    }
}