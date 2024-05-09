<?php

namespace Seeme\Components\Ajax\Interface;

interface IAjaxAction
{
    public function performAction();

    public function getAction(): string;

    public function verifyRequest();
}
