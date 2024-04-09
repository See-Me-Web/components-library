<?php

namespace Seeme\Components\View\Components;

use Illuminate\Support\Arr;
use Roots\Acorn\View\Component;

abstract class BaseComponent extends Component
{
    protected $name = '';
    protected $config = [];
    protected $namespace = 'sm-components';

    abstract protected function with(): array;

    public function __construct()
    {
      $this->config = Arr::get(config('sm-components'), $this->name, []);
      $this->namespace = Arr::get(config('sm-components'), 'namespace', 'sm-components');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
      return $this->view("$this->namespace::components.$this->name", $this->with());
    }
}