<?php

namespace Seeme\Components\Services;

use Illuminate\Contracts\Foundation\Application;

class BlocksService 
{
    protected $app = null;

    public $blockCategories = [
        [
            'slug' => 'sm-blocks',
            'title' => 'SM Blocks'
        ]
    ];

    public function __construct(Application $app) {
        $this->app = $app;
    }

    public function init(): void
    {
        $this->registerActions();
        $this->registerBlocks();
    }

    /**
     * Register ACF Blocks actions and filters
     * 
     * @return void
     */
    public function registerActions(): void
    {
        add_filter('block_categories_all', [$this, 'registerBlockCategories'], 10, 1);
    }

    /**
     * Register ACF Blocks with compose
     * 
     * @return void
     */
    public function registerBlocks(): void
    {
        $blocks = glob(__DIR__ . '/../Blocks/*.php');
        $blocksToLoad = config('sm-components.blocks', []);

        foreach($blocks as $block) {
            $blockName = basename($block, '.php');

            if( is_array($blocksToLoad) && !empty($blocksToLoad) && !in_array($blockName, $blocksToLoad) ) {
                continue;
            }

            $class = 'Seeme\\Components\\Blocks\\' . basename($block, '.php');
            $this->app->make($class)->compose();
        }
    }

    /**
     * Add custom block category to the Gutenberg editor.
     * 
     * @param array $categories
     * 
     * @return array
     */
    public function registerBlockCategories($categories): array
    {
        return array_merge($this->blockCategories, $categories);
    }
}