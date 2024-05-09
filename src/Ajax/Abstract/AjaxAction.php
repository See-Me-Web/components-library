<?php

namespace Seeme\Components\Ajax\Abstract;

use Seeme\Components\Ajax\Interface\IAjaxAction;

abstract class AjaxAction implements IAjaxAction
{
    const ACTION = '';

    /**
     * @return array
     */
    abstract public function getResponseData(): array;

    /**
     * @return void
     */
    public function performAction()
    {
        $data = $this->getResponseData();
        $this->handleRequest($data);
    }

    /**
     * @param  array  $data
     *
     * @return void
     */
    public function handleRequest(array $data = [])
    {
        wp_send_json($data);
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return static::ACTION;
    }

    /**
     * @return void
     */
    public function verifyRequest()
    {
        if ( ! check_ajax_referer(static::ACTION)) {
            wp_send_json_error('Invalid request');
            die;
        };
    }
}
