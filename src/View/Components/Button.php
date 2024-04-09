<?php

namespace Seeme\Components\View\Components;

use Illuminate\Support\Arr;
use Roots\Acorn\View\Component;

class Button extends Component
{
    protected $style = 'primary';
    protected $size = 'medium';

    public function __construct(string $style = 'primary', string $size = 'medium')
    {   
        $this->style = $style;
        $this->size = $size;   
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return $this->view('components.button', [
            'buttonClasses' => Arr::toCssClasses([
                Arr::get(config('components.button'), 'defaults', ''),
                Arr::get(config('components.button.styles'), $this->style, ''),
                Arr::get(config('components.button.sizes'), $this->size, ''),
            ])
        ]);
    }
}