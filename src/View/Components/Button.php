<?php

namespace Seeme\Components\View\Components;

use Illuminate\Support\Arr;

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
        return [
            'classes' => $this->getClasses()
        ];
    }

    public function getClasses()
    {
        return Arr::toCssClasses([
            $this->getDefaults(),
            $this->getVariantClasses(),
            $this->getSizeClasses()
        ]);
    }

    public function getVariantClasses(): string
    {
        return Arr::toCssClasses(
            Arr::get($this->getVariants(), $this->variant, [])
        );
    }

    public function getSizeClasses(): string
    {
        return Arr::toCssClasses(
            Arr::get($this->getSizes(), $this->size, [])
        );
    }

    public function getVariants(): array
    {
        return Arr::get($this->getConfig(), 'variants', []);
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