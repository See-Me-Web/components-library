<?php

namespace Seeme\Components\View\Composers;

use Roots\Acorn\View\Composer;

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
        'postType' => get_post_type($id),
      ];
    }
}
