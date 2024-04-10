<?php

namespace Seeme\Components\View\Components;

use Illuminate\Support\Arr;

class Heading extends BaseComponent
{
    protected string $name = 'heading';

    public function __construct()
    {

    }

    public function with(): array
    {
        return [];
    }
}