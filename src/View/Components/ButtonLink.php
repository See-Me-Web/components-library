<?php

namespace Seeme\Components\View\Components;

use Illuminate\Support\Arr;
use Seeme\Components\Helpers\ArrHelper;
use Seeme\Components\Partials\ButtonLink as PartialsButtonLink;
use Seeme\Components\View\Components\Abstract\BaseComponent;

class ButtonLink extends BaseComponent
{
    protected string $name = 'button-link';
    protected $variant = 'primary';
    protected $size = 'medium';
    protected $weight = 'regular';
    protected $rounded = 'full';
    protected $partial = null;

    public function __construct(
        string $variant = 'primary', 
        string $size = 'medium', 
        string $weight = 'regular',
        string $rounded = 'full'
    )
    {   
        $this->variant = $variant;
        $this->size = $size;
        $this->weight = $weight;
        $this->rounded = $rounded;
        $this->partial = new PartialsButtonLink([
            'args' => [
                'variant' => $variant,
                'size' => $size,
                'weight' => $weight,
                'rounded' => $rounded
            ]
        ]);
    }

    public function with(): array
    {
        return [
            'classes' => Arr::toCssClasses($this->partial->getClasses()),
            'styles' => ArrHelper::toCssStyles($this->partial->getStyles())
        ];
    }
}