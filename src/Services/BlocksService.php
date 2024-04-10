<?php

namespace Seeme\Components\Services;

use Illuminate\Contracts\Foundation\Application;

class BlocksService {
    public function __construct(
        protected Application $app
    ) {}

    public function registerActions(): void
    {
        add_filter('block_categories_all', [$this, 'addCustomBlockCategory'], 10, 1);
    }

    /**
     * Add custom block category to the Gutenberg editor.
     * 
     * @param array $categories
     * 
     * @return array
     */
    public function addCustomBlockCategory($categories): array
    {
        $categories[] = [
          'slug' => 'sm-blocks',
          'title' => 'SM Blocks'
        ];

        return $categories;
    }
}