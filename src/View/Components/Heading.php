<?php

namespace Seeme\Components\View\Components;

use Seeme\Components\Helpers\HeadingHelper;
use Seeme\Components\View\Components\Abstract\BaseComponent;

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
          'classes' => HeadingHelper::getClasses($this->size)
        ];
    }
}