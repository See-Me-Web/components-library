<?php

namespace Seeme\Components\View\Components;

use Illuminate\Support\Arr;
use Seeme\Components\Helpers\ArrHelper;
use Seeme\Components\Partials\Wrapper as PartialsWrapper;
use Seeme\Components\View\Components\Abstract\BaseComponent;

class Wrapper extends BaseComponent
{
    protected string $name = 'wrapper';
    protected $maxWidth = 'md';
    protected $align = 'center';
    protected $partial = null;

    public function __construct(string $maxWidth = 'md', string $align = 'center')
    {
      $this->maxWidth = $maxWidth;
      $this->align = $align;

      $this->partial = new PartialsWrapper([
        'args' => [
          'maxWidth' => $maxWidth,
          'align' => $align
        ]
      ]);
    }

    public function with(): array
    {
        return [
          'styles' => ArrHelper::toCssStyles($this->partial->getStyles()),
          'classes' => Arr::toCssClasses($this->partial->getClasses())
        ];
    }
}