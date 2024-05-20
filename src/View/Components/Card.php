<?php

namespace Seeme\Components\View\Components;

use Illuminate\Support\Arr;
use Seeme\Components\Helpers\ArrHelper;
use Seeme\Components\Partials\Card as PartialsCard;
use Seeme\Components\View\Components\Abstract\BaseComponent;

class Card extends BaseComponent
{
    protected string $name = 'card';
    protected string $variant = 'primary';
    protected int | bool $post = false;
    protected $partial = null;

    public function __construct(string $variant = '', int | bool $post = false)
    {
      $this->variant = $variant;
      $this->post = $post;

      $attributes = [];
      
      if( $variant ) {
        $attributes['args'] = [
          'variant' => $variant
        ];
      }

      if( $post ) {
        $attributes['postId'] = $post;
      }

      $this->partial = new PartialsCard($attributes);
    }

    public function with(): array
    {
        return [
          'classes' => Arr::toCssClasses($this->partial->getClasses()),
          'styles' => ArrHelper::toCssStyles($this->partial->getStyles()),
        ];
    }
}