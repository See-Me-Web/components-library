<?php

namespace Seeme\Components\View\Components;

use Illuminate\Support\Arr;
use Seeme\Components\Partials\Button as PartialsButton;
use Seeme\Components\View\Components\Abstract\BaseComponent;

class Button extends BaseComponent
{
    protected string $name = 'button';
    protected $variant = 'primary';
    protected $size = 'medium';
    protected $partial = null;

    public function __construct(string $variant = 'primary', string $size = 'medium')
    {   
        $this->variant = $variant;
        $this->size = $size;
        $this->partial = new PartialsButton([
            'args' => [
                'variant' => $variant,
                'size' => $size
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