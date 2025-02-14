<?php

namespace Seeme\Components\Blocks;

use Log1x\AcfComposer\AcfComposer;
use Seeme\Components\Ajax\PostsFeedAjax;
use Seeme\Components\Blocks\Abstract\BaseBlock;
use Seeme\Components\Helpers\ConfigHelper;
use Seeme\Components\Partials\Variant;
use Seeme\Components\Providers\CoreServiceProvider;
use StoutLogic\AcfBuilder\FieldsBuilder;

class DynamicPosts extends BaseBlock
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
    public $view = CoreServiceProvider::NAMESPACE . '::blocks.dynamic-posts';

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
        'slug' => 'dynamic-posts',
        'name' => __('Dynamic posts', 'sm-components'),
        'description' => __('Dynamic posts loaded via AJAX without page refresh', 'sm-components'),
        'icon' => 'welcome-write-blog',
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
        $withFilters = get_field('withFilters');
        $withFilters = $withFilters === null ? true : $withFilters;
        $postType = get_field('postType') ?: 'post';

        $settings = [
          'perPage'   => get_field('perPage') ?: 4,
          'postType'  => $postType
        ];

        $initialQuery = PostsFeedAjax::getPosts([
          ...$settings,
          'page' => 1,
        ]);

        return [
          'columns' => get_field('columns') ?: 3,
          'mobileVertical' => $mobileVertical == null ? true : $mobileVertical,
          'mobileColumns' => get_field('mobile-columns') ?: 1,
          'posts' => $initialQuery->posts,
          'categories' => $withFilters === true ? PostsFeedAjax::getCategories($postType) : [],
          'action' => PostsFeedAjax::ACTION,
          'nonce' => wp_create_nonce(PostsFeedAjax::ACTION),
          'settings' => [
            ...$settings,
            'maxPages' => ceil($initialQuery->found_posts / $settings['perPage'])
          ],
          'allowedBlocks' => [
            'acf/heading'
          ],
          'blockVariant' => $this->partials['variant']->getVariant()
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
          ->addFields($this->partials['variant']->fields())
          ->addAccordion('Ustawienia bloku')
            ->addRange('perPage', [
              'label' => 'Liczba postów na stronę',
              'min' => 2,
              'max' => 10,
              'default_value' => 4
            ])
            ->addSelect('postType', [
              'label' => 'Rodzaj postów',
              'choices' => ConfigHelper::getPostTypes(),
              'default_value' => 'post'
            ])
            ->addTrueFalse('withFilters', [
              'label' => 'Włącz filtrowanie po kategorii',
              'default_value' => true
            ])
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
