<?php

namespace Seeme\Components\View\Components;

use Illuminate\Support\Arr;

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
            'buttonClasses' => $this->getButtonClasses()
        ];
    }

    public function getButtonClasses()
    {
        return Arr::toCssClasses([
            $this->getButtonStyleClasses()
        ]);
    }

    public function getButtonStyleClasses(): string
    {
        return Arr::toCssClasses(
            Arr::get($this->getStyles(), $this->style, [])
        );
    }

    public function getStyles(): array
    {
        return Arr::get($this->config, 'styles', []);
    }
}