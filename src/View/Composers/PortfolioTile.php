<?php

namespace Seeme\Components\View\Composers;

use Roots\Acorn\View\Composer;
use Seeme\Components\Helpers\PortfolioHelper;

class PortfolioTile extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'seeme::partials.portfolio.tile',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
      $id = $this->data->get('id');

      return PortfolioHelper::prepareForTile($id);
    }
}
