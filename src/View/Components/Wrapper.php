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
    protected $partial = null;

    public function __construct(string $maxWidth = 'md')
    {
      $this->maxWidth = $maxWidth;
      $this->partial = new PartialsWrapper([
        'args' => [
          'maxWidth' => $maxWidth
        ]
      ]);
    }

    public function with(): array
    {
        return [
          'maxWidth' => $this->maxWidth,
          'styles' => ArrHelper::toCssStyles($this->partial->getStyles()),
          'classes' => Arr::toCssClasses($this->partial->getClasses())
        ];
    }
}