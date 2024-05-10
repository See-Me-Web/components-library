<?php

namespace Seeme\Components\Blocks;

use Seeme\Components\Blocks\Abstract\BaseBlock;
use Seeme\Components\Helpers\PostsHelper;
use Seeme\Components\Helpers\ViewHelper;
use Seeme\Components\Providers\CoreServiceProvider;
use StoutLogic\AcfBuilder\FieldsBuilder;

class PostHero extends BaseBlock
{
    public $styles_support = ['background'];
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Post hero';

    /**
     * The block view.
     */
    public $view = CoreServiceProvider::NAMESPACE . '::blocks.post-hero';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Post hero';

    /**
     * The block icon.
     *
     * @var string|array
     */
    public $icon = 'tagcloud';

    /**
     * The block keywords.
     *
     * @var array
     */
    public $keywords = [
        'post-hero'
    ];

    /**
     * The block post type allow list.
     *
     * @var array
     */
    public $post_types = [
      'post',
      'portfolio',
      'offer'
    ];

    /**
     * The parent block type allow list.
     *
     * @var array
     */
    public $parent = [];

    /**
     * The default block mode.
     *
     * @var string
     */
    public $mode = 'preview';

    /**
     * The default block alignment.
     *
     * @var string
     */
    public $align = '';

    /**
     * The default block text alignment.
     *
     * @var string
     */
    public $align_text = '';

    /**
     * The default block content alignment.
     *
     * @var string
     */
    public $align_content = '';

    /**
     * The supported block features.
     *
     * @var array
     */
    public $supports = [
        'align' => false,
        'align_text' => true,
        'align_content' => false,
        'full_height' => false,
        'anchor' => true,
        'mode' => true,
        'multiple' => true,
        'jsx' => true,
        'spacing' => [
          'padding' => true,
          'margin' => true,
          'blockGap' => true
        ],
        'color' => [
          'background' => false,
          'text' => true,
        ],
    ];

    /**
     * The block styles.
     *
     * @var array
     */
    public $styles = [];

    /**
     * Data to be passed to the block before rendering.
     *
     * @return array
     */
    public function getWith(): array
    {
        $postId = get_the_ID();

        return [
          'title' => get_the_title(),
          'thumbnail' => PostsHelper::getThumbnail($postId),
          'categories' => ViewHelper::listCategories(PostsHelper::getTopLevelCategories($postId))
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function getBlockFields(): FieldsBuilder
    {
        $builder = new FieldsBuilder('post-hero');

        return $builder;
    }
}