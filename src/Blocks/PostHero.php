<?php

namespace Seeme\Components\Blocks;

use Seeme\Components\Blocks\Abstract\BaseBlock;
use Seeme\Components\Helpers\PostsHelper;
use Seeme\Components\Helpers\ViewHelper;
use Seeme\Components\Providers\CoreServiceProvider;
use StoutLogic\AcfBuilder\FieldsBuilder;

class PostHero extends BaseBlock
{
    public $category = 'sm-blocks-posts';

    /**
     * The block styles.
     */
    public $styles_support = ['background'];

    /**
     * The block view path.
     */
    public $view = CoreServiceProvider::NAMESPACE . '::blocks.post-hero';

    /**
     * The block attributes.
     */
    public function attributes(): array
    {
      return [
        'slug' => 'post-hero',
        'name' => __('Post hero', 'sm-components'),
        'description' => __('Post hero block', 'sm-components'),
        'icon' => 'tagcloud',
        'keywords' => ['hero'],
        'post_types' => ['post', 'portfolio', 'offer'],
        'parent' => [],
        'mode' => 'preview',
        'supports' => [
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
        ]
      ];
    }

    /**
     * Data to be passed to the block before rendering.
     *
     * @return array
     */
    public function getWith(): array
    {
        $postId = get_the_ID();
        $showCategories = boolval(get_field('show-categories'));

        return [
          'title' => get_the_title(),
          'thumbnail' => PostsHelper::getThumbnail($postId),
          'categories' => $showCategories ? ViewHelper::listCategories(PostsHelper::getTopLevelCategories($postId)) : '',
        ];
    }

    /**
     * The block field group.
     *
     * @return FieldsBuilder
     */
    public function getBlockFields(): FieldsBuilder
    {
        $builder = new FieldsBuilder($this->getSlug());

        $builder
          ->addTrueFalse('show-categories', [
            'label' => 'Wyświetl kategorie'
          ]);

        return $builder;
    }
}
