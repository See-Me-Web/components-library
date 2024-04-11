<?php

namespace Seeme\Components\View\Components\Abstract;

use Roots\Acorn\View\Component;
use Seeme\Components\Providers\CoreServiceProvider;

abstract class BaseComponent extends Component
{
    /**
     * Component name
     */
    protected string $name = '';

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