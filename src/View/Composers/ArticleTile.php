<?php

namespace Seeme\Components\View\Composers;

use Roots\Acorn\View\Composer;
use Seeme\Components\Helpers\ArticleHelper;

class ArticleTile extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'seeme::partials.article.tile',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
      $id = $this->data->get('id');
      $override = $this->data->get('override', []);

      return ArticleHelper::prepareForTile($id, $override);
    }
}
