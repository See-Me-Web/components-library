<?php

namespace Seeme\Components\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \App\Services\AjaxListenerService listen($action, $callback, $onlyLogged = false)
 *
 * @see \App\Services\AjaxListenerService
 */
class Ajax extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'ajax';
    }
}
