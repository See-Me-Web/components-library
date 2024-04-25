<?php

namespace Seeme\Components\Helpers;

class ViewHelper
{
  public static function prepareLink(array $link = []): array
  {
    return [
      'url' => $link['url'] ?? '#',
      'label' => $link['label'] ?? '',
      'target' => $link['target'] ?? '_self'
    ];
  }

  public static function prepareImage(int $imageId = 0, string $size = 'default')
  {
    $imageSrc = wp_get_attachment_image_src($imageId, $size);

    return (object) [
      'url' => $imageSrc[0] ?? '',
      'alt' => get_post_meta($imageId, '_wp_attachment_image_alt', true),
      'width' => $imageSrc[1] ?? '',
      'height' => $imageSrc[2] ?? ''
    ];
  }
}