<?php

namespace Seeme\Components\View\Components;

use Seeme\Components\Helpers\WrapperHelper;
use Seeme\Components\View\Components\Abstract\BaseComponent;

class Wrapper extends BaseComponent
{
    protected string $name = 'wrapper';
    protected $size = 'xl';

    public function __construct(string $size = 'xl')
    {
      $this->size = $size;
    }

    public function with(): array
    {
        return [
          'classes' => WrapperHelper::getClasses($this->size)
        ];
    }
}