<?php

namespace Seeme\Components\Helpers;

use Illuminate\Support\Facades\Cache;

class CacheHelper {
  public static function conditionalRemember(bool $enable = true, string $key, $ttl, $callback) 
  {
    if( ! $enable ) {
      return $callback();
    }  

    return Cache::remember($key, $ttl, $callback);
  }
}