<?php

namespace Seeme\Components\View\Components;

use Seeme\Components\View\Components\Abstract\BaseComponent;

class Button extends BaseComponent
{
    protected string $name = 'button';
    protected $variant = 'primary';
    protected $size = 'medium';

    public function __construct(string $variant = 'primary', string $size = 'medium')
    {   
        $this->variant = $variant;
        $this->size = $size;   
    }

    public function with(): array
    {
        return [];
    }
}