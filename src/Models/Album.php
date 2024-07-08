<?php

namespace Seeme\Components\Models;

use Illuminate\Support\Str;
use Seeme\Components\Helpers\ViewHelper;

class Album {
  public $title;
  public $slug;
  public array $images = [];

  public function __construct(string $title, string $slug = '') {
    $this->title = $title;
    $this->slug = empty($slug) ? Str::slug($title) : $slug;
  } 

  public function setImages(array $images)
  {
    $this->images = array_map(fn($image) => ViewHelper::prepareImage($image, 'large'), $images);
  }
}