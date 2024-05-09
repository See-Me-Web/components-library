<?php

namespace Seeme\Components\Services;

class AjaxListenerService
{
    /**
     * @param  string  $action
     * @param  \Closure|string  $callback
     * @param  bool  $onlyLogged
     * @return self
     */
    public function listen(string $action, $callback, bool $onlyLogged = false): AjaxListenerService
    {
        $actions = ["wp_ajax_{$action}"];

        if (! $onlyLogged) {
            $actions[] = "wp_ajax_nopriv_{$action}";
        }

        foreach ($actions as $ajaxAction) {
            add_action($ajaxAction, $callback);
        }

        return $this;
    }
}
