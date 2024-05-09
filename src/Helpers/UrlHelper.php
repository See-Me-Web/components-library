<?php

namespace Seeme\Components\Helpers;

class UrlHelper
{
  public static function getAjaxUrl(string $action, array $data = []): string
  {
    return add_query_arg([
      'action' => $action,
      ...$data
    ], admin_url('admin-ajax.php'));
  }
}