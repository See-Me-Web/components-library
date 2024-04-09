<?php

namespace Seeme\Components\View\Components;

class Button extends BaseComponent
{
    protected $name = 'button';
    protected $style = 'primary';
    protected $size = 'medium';

    public function __construct(string $style = 'primary', string $size = 'medium')
    {   
        $this->style = $style;
        $this->size = $size;   
    }

    public function with(): array
    {
        return [
            'buttonClass' => 'test'
        ];
    }
}