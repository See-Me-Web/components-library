<?php

namespace Seeme\Components\View\Components;

use Illuminate\Support\Arr;
use Roots\Acorn\View\Component;
use Seeme\Components\Providers\CoreServiceProvider;

abstract class BaseComponent extends Component
{
    /**
     * Component's name
     */
    protected string $name = '';
    protected $config = [];

    /**
     * Returns data passed to component's view
     * 
     * @return array
     */
    abstract protected function with(): array;

    /**
     * Returns mergeData passed to component's view
     * 
     * @return array
     */
    protected function withMerge(): array 
    {
      return [];
    }

    public function __construct()
    {
      $this->config = Arr::get(config('sm-components'), $this->name, []);
    }

    /**
     * Returns view file name in dot notation
     * 
     * @return string
     */
    public function getViewName(): string
    {
      return sprintf('components.%s', $this->name);
    }

    /**
     * Returns view file name in dot notation prefixed with package namespace
     * 
     * @return string
     */
    public function getNamespacedViewName(): string 
    {
      return sprintf("%s::%s", CoreServiceProvider::NAMESPACE, $this->getViewName());
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
      return $this->view(
        $this->getNamespacedViewName(),
        $this->with(), 
        $this->withMerge()
      );
    }
}