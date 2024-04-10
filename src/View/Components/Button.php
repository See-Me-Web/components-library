<?php

namespace Seeme\Components\View\Components;

use Illuminate\Support\Arr;

class Button extends BaseComponent
{
    protected string $name = 'button';
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
            $this->getDefaults(),
            $this->getButtonStyleClasses(),
            $this->getButtonSizeClasses()
        ]);
    }

    public function getButtonStyleClasses(): string
    {
        return Arr::toCssClasses(
            Arr::get($this->getStyles(), $this->style, [])
        );
    }

    public function getButtonSizeClasses(): string
    {
        return Arr::toCssClasses(
            Arr::get($this->getSizes(), $this->size, [])
        );
    }

    public function getStyles(): array
    {
        return Arr::get($this->getConfig(), 'styles', []);
    }

    public function getSizes(): array
    {
        return Arr::get($this->getConfig(), 'sizes', []);
    }

    public function getDefaults(): string
    {
        return Arr::toCssClasses(Arr::get($this->getConfig(), 'defaults', []));
    }
}