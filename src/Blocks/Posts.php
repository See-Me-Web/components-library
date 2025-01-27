<?php

namespace Seeme\Components\Blocks;

use Log1x\AcfComposer\AcfComposer;
use Seeme\Components\Ajax\PostsFeedAjax;
use Seeme\Components\Blocks\Abstract\BaseBlock;
use Seeme\Components\Helpers\ConfigHelper;
use Seeme\Components\Partials\Variant;
use Seeme\Components\Providers\CoreServiceProvider;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Posts extends BaseBlock
{
    public $category = 'sm-blocks-posts';

    /**
     * The block styles.
     */
    public $styles_support = ['background', 'text', 'border', 'shadow'];

    public $partials = [];

    /**
     * The block view path.
     */
    public $view = CoreServiceProvider::NAMESPACE . '::blocks.posts';

    /**
     * The block constructor.
     */
    public function __construct(AcfComposer $composer)
    {
        $this->partials = [
          'variant' => new Variant()
        ];

        parent::__construct($composer);
    }

    /**
     * The block attributes.
     */
    public function attributes(): array
    {
      return [
        'slug' => 'posts',
        'name' => __('Posts', 'sm-components'),
        'description' => __('Posts block', 'sm-components'),
        'icon' => 'tagcloud',
        'keywords' => ['posts'],
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
            'blockGap' => true
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
        $mobileVertical = get_field('mobile-vertical');

        return [
          'columns' => get_field('columns') ?: 3,
          'mobileVertical' => $mobileVertical == null ? true : $mobileVertical,
          'mobileColumns' => get_field('mobile-columns') ?: 1,
          'posts' => $this->getPosts(),
          'blockVariant' => $this->partials['variant']->getVariant()
        ];
    }

    public function getPosts(): array
    {
      $mode = get_field('mode') ?: 'all';

      if( $mode === 'chosen' ) {
        return get_field('posts') ?: [];
      }

      $perPage = -1;

      if( $mode === 'newest' ) {
        $perPage = get_field('perPage') ?: 3;
      }

      $query = PostsFeedAjax::getPosts([
        'postType' => get_field('postType') ?: 'post',
        'perPage' => $perPage
      ]);

      return array_map(fn ($post) => $post->ID, $query->posts);
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
          ->addFields($this->partials['variant']->fields())
          ->addAccordion('Posty')
            ->addSelect('mode', [
              'label' => 'Tryb bloku',
              'choices' => [
                'chosen' => 'Wybrane posty',
                'all' => 'Wszystkie posty',
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
                  'relation' => 'OR',
                  [
                    'field' => 'mode',
                    'operator' => '==',
                    'value' => 'all'
                  ],
                  [
                    'field' => 'mode',
                    'operator' => '==',
                    'value' => 'newest'
                  ],
                ]
              ]
            ])
            ->addRange('perPage', [
              'label' => 'Liczba postów',
              'min' => 1,
              'default_value' => 3,
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
          ->addAccordion('Ustawienia bloku')
            ->addRange('columns', [
              'label' => 'Liczba kolumn',
              'min' => 1,
              'max' => 6,
              'step' => 1,
              'default_value' => 3
            ])
            ->addTrueFalse('mobile-vertical', [
              'label' => 'Zmień orientację na pionową dla urządzeń mobilnych',
              'default_value' => true
            ])
            ->addRange('mobile-columns', [
              'label' => 'Liczba kolumn dla urządzeń mobilnych',
              'min' => 1,
              'max' => 6,
              'step' => 1,
              'default_value' => 1,
              'conditional_logic' => [
                [
                  [
                    'field' => 'mobile-vertical',
                    'operator' => '==',
                    'value' => 1
                  ]
                ]
              ]
            ]);

        return $builder;
    }

    public function getAdditionalStyles(): array
    {
      $columns = get_field('columns') ?: 3;
      $mobileColumns = get_field('mobile-columns') ?: 1;

      return [
        "--columns: repeat({$columns}, minmax(0, 1fr))",
        "--mobile-columns: repeat({$mobileColumns}, minmax(0, 1fr))",
      ];
    }
}
