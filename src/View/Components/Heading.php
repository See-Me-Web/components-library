<?php

namespace Seeme\Components\View\Components;

use Illuminate\Support\Arr;

class Heading extends BaseComponent
{
    protected string $name = 'heading';
    protected $size = 'md';
    protected $element = 'h3';

    public function __construct(string $size = 'md', string $element = 'h3')
    {
      $this->size = $size;
      $this->element = $element;
    }

    public function with(): array
    {
        return [
          'classes' => $this->getClasses()
        ];
    }

    public function getClasses()
    {
        return Arr::toCssClasses([
            Arr::get(Arr::get($this->getConfig(), 'sizes', []), $this->size, '')
        ]);
    }
}