<?php

namespace Seeme\Components\View\Components;

use Illuminate\Support\Arr;
use Roots\Acorn\View\Component;
use Seeme\Components\Providers\CoreServiceProvider;

abstract class BaseComponent extends Component
{
    protected $name = '';
    protected $config = [];

    abstract protected function with(): array;

    public function __construct()
    {
      $this->config = Arr::get(config('sm-components'), $this->name, []);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
      $namespace = CoreServiceProvider::NAMESPACE;

      return $this->view("$namespace::components.$this->name", $this->with());
    }
}