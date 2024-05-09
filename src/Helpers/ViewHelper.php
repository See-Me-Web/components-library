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

  /**
   * Return object with url, alternate text, width and height of the image
   * 
   * @param int $imageId attachment id
   * @param string $size size of the image
   * 
   * @return object
   */
  public static function prepareImage(int $imageId = 0, string $size = 'default'): object
  {
    $imageSrc = wp_get_attachment_image_src($imageId, $size);

    return (object) [
      'url' => $imageSrc[0] ?? '',
      'alt' => get_post_meta($imageId, '_wp_attachment_image_alt', true),
      'width' => $imageSrc[1] ?? '',
      'height' => $imageSrc[2] ?? ''
    ];
  }

  public static function listCategories(array $categories = []): string
  {
    return implode(', ', array_map(fn ($cat) => '<a href="' . get_category_link($cat) . '">' . $cat->name . '</a>', $categories));
  }
}