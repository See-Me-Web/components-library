<?php

namespace Seeme\Components\View\Composers;

use Roots\Acorn\View\Composer;
use Seeme\Components\Helpers\ViewHelper;

class PostTile extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'seeme::partials.post.tile',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
      $id = $this->data->get('id');
      
      return [
        'permalink' => get_the_permalink($id),
        'date' => get_the_date(get_option('date_format'), $id),
        'title' => get_the_title($id),
        'excerpt' => apply_filters('orphan_replace', get_the_excerpt($id)),
        'thumbnail' => has_post_thumbnail($id) ? ViewHelper::prepareImage(get_post_thumbnail_id($id), 'large') : false
      ];
    }
}
