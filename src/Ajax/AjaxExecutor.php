<?php

namespace Seeme\Components\Ajax;

use Seeme\Components\Facades\Ajax;
use Seeme\Components\Ajax\Interface\IAjaxAction;

class AjaxExecutor
{
    private $instances;

    public function addAjaxAction(IAjaxAction $instance)
    {
        $this->instances[] = $instance;
    }

    public function execute()
    {
        foreach ($this->instances as $instance) {
          /**
           * @var IAjaxAction $instance
           */
            Ajax::listen($instance->getAction(), function () use ($instance) {
                $instance->verifyRequest();
                $instance->performAction();
            });
        }
    }
}
