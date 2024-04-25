<?php

namespace Seeme\Components\Blocks;

use Seeme\Components\Blocks\Abstract\BaseBlock;
use Seeme\Components\Providers\CoreServiceProvider;
use StoutLogic\AcfBuilder\FieldsBuilder;

class PostCard extends BaseBlock
{
    public $styles_support = ['border', 'background', 'shadow'];

    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Post card';

    /**
     * The block view.
     */
    public $view = CoreServiceProvider::NAMESPACE . '::blocks.post-card';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Post card';

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
        'card'
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
        'align_text' => true,
        'align_content' => false,
        'full_height' => false,
        'anchor' => true,
        'mode' => true,
        'multiple' => true,
        'jsx' => true,
        'spacing' => [
          'padding' => true,
          'margin' => true
        ],
        'color' => [
          'text' => true,
          'background' => true
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
        return [
          'id' => get_field('post') ?: 0,
          'postType' => get_post_type(get_field('post') ?: 0),
          'cardWidth' => get_field('cardWidth') ?: 1
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function getBlockFields(): FieldsBuilder
    {
        $builder = new FieldsBuilder('post-card');

        $builder
          ->addAccordion('Ustawienia bloku')
          ->addPostObject('post', [
            'label' => 'Post',
            'return_format' => 'id'
          ])
          ->addRange('cardWidth', [
            'label' => 'Szerokość karty',
            'min' => 1,
            'max' => 6,
            'step' => 1,
            'default_value' => 1,
          ]);

        return $builder;
    }

    public function getAdditionalStyles(): array
    {
      $cardWidth = get_field('cardWidth') ?: 1;
      
      return [
        "--card-width: span {$cardWidth} / span {$cardWidth}"
      ];
    }
}
