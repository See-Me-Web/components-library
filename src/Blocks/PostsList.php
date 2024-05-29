<?php

namespace Seeme\Components\Blocks;

use Seeme\Components\Ajax\PostsFeedAjax;
use Seeme\Components\Blocks\Abstract\BaseBlock;
use Seeme\Components\Helpers\ConfigHelper;
use Seeme\Components\Providers\CoreServiceProvider;
use StoutLogic\AcfBuilder\FieldsBuilder;

class PostsList extends BaseBlock
{
    public $category = 'sm-blocks-posts';
    
    /**
     * The block view path.
     */
    public $view = CoreServiceProvider::NAMESPACE . '::blocks.posts-list';

    /**
     * The block attributes.
     */
    public function attributes(): array
    {
      return [
        'slug' => 'posts-list',
        'name' => __('Posts list', 'sm-components'),
        'description' => __('Posts list block', 'sm-components'),
        'icon' => 'tagcloud',
        'keywords' => ['posts', 'list'],
        'post_types' => [],
        'parent' => [],
        'mode' => 'preview',
        'supports' => [
          'align' => false,
          'align_text' => false,
          'align_content' => false,
          'full_height' => false,
          'anchor' => true,
          'mode' => true,
          'multiple' => true,
          'jsx' => true,
          'spacing' => [
            'padding' => true,
            'margin' => true,
          ],
          'color' => [
            'text' => true,
            'background' => false
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
        return [
          'posts' => $this->getPosts(),
        ];
    }

    public function getPosts(): array
    {
      return array_map(fn($postId) => [
        'title' => get_the_title($postId),
        'permalink' => get_the_permalink($postId)
      ], $this->getPostsIds());
    }

    public function getPostsIds(): array
    {
      $mode = get_field('mode') ?: 'newest';

      if( $mode === 'chosen' ) {
        return get_field('posts') ?: [];
      }

      $query = PostsFeedAjax::getPosts([
        'postType' => get_field('postType') ?: 'post',
        'perPage' => get_field('perPage') ?: 5,
        'orderBy' => 'date'
      ]);

      return array_map(fn ($post) => $post->ID, $query->posts);
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function getBlockFields(): FieldsBuilder
    {
        $builder = new FieldsBuilder($this->getSlug());

        $builder
          ->addAccordion('Posty')
            ->addSelect('mode', [
              'label' => 'Tryb bloku',
              'choices' => [
                'chosen' => 'Wybrane posty',
                'newest' => 'Najnowsze posty'
              ],
              'default_value' => 'newest'
            ])
            ->addPostObject('posts', [
              'label' => 'Posty',
              'post_type' => ConfigHelper::getPostTypes(true),
              'return_format' => 'id',
              'multiple' => true,
              'conditional_logic' => [
                [
                  [
                    'field' => 'mode',
                    'operator' => '==',
                    'value' => 'chosen'
                  ]
                ]
              ]
            ])
            ->addSelect('postType', [
              'label' => 'Typ treści',
              'choices' => ConfigHelper::getPostTypes(),
              'default_value' => 'post',
              'conditional_logic' => [
                [
                  [
                    'field' => 'mode',
                    'operator' => '==',
                    'value' => 'newest'
                  ]
                ]
              ]
            ])
            ->addNumber('perPage', [
              'label' => 'Liczba postów',
              'min' => 1,
              'default_value' => 5,
              'conditional_logic' => [
                [
                  [
                    'field' => 'mode',
                    'operator' => '==',
                    'value' => 'newest'
                  ]
                ]
              ]
            ]);

        return $builder;
    }
}
