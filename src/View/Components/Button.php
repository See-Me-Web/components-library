<?php

namespace Seeme\Components\View\Components;

use Roots\Acorn\View\Component;

class Button extends Component
{
    public function __construct()
    {

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return $this->view('components.button');
    }
}