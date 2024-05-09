<?php

namespace Seeme\Components\Blocks;

use Seeme\Components\Blocks\Abstract\BaseBlock;
use Seeme\Components\Providers\CoreServiceProvider;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Posts extends BaseBlock
{
    public $styles_support = ['background', 'text', 'border', 'shadow'];

    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Posts';

    /**
     * The block view.
     */
    public $view = CoreServiceProvider::NAMESPACE . '::blocks.posts';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Posts';

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
        'post',
        'posts'
    ];

    /**
     * The block post type allow list.
     *
     * @var array
     */
    public $post_types = [];

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
        $mobileVertical = get_field('mobile-vertical');

        return [
          'columns' => get_field('columns') ?: 3,
          'mobileVertical' => $mobileVertical == null ? true : $mobileVertical,
          'mobileColumns' => get_field('mobile-columns') ?: 1,
          'posts' => get_field('posts') ?: []
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function getBlockFields(): FieldsBuilder
    {
        $builder = new FieldsBuilder('posts');

        $builder
          ->addAccordion('Posty')
            ->addRelationship('posts', [
              'label' => 'Posty',
              'return_format' => 'id',
              'multiple' => true
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

    public function getAdditionalClasses(): array
    {
      return [];
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
