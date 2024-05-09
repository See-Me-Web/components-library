<?php

namespace Seeme\Components\Services;

use Illuminate\Contracts\Foundation\Application;
use Seeme\Components\Ajax\AjaxExecutor;
use Seeme\Components\Ajax\PostsFeedAjax;

class AjaxService 
{
    protected $app = null;
    protected $executor = null;
    protected $actions = [];

    public function __construct(Application $app) {
      $this->app = $app;
      $this->executor = new AjaxExecutor();
    }

    public function init(): void
    {
      $this->actions[] = new PostsFeedAjax();
    }

    public function execute()
    {
      foreach($this->actions as $action)
      {
        $this->executor->addAjaxAction($action);
      }

      $this->executor->execute();
    }
}