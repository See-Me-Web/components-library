<?php

namespace Seeme\Components\Blocks;

use Seeme\Components\Blocks\Abstract\BaseBlock;
use Seeme\Components\Providers\CoreServiceProvider;
use StoutLogic\AcfBuilder\FieldsBuilder;

class FAQ extends BaseBlock
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'FAQ';

    /**
     * The block view.
     */
    public $view = CoreServiceProvider::NAMESPACE . '::blocks.faq';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'FAQ section with questions and answers';

    /**
     * The block icon.
     *
     * @var string|array
     */
    public $icon = 'info';

    /**
     * The block keywords.
     *
     * @var array
     */
    public $keywords = [
        'faq'
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
        'align' => true,
        'align_text' => false,
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
        'colors' => [
          'text' => true,
          'background' => true
        ]
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
    public function with()
    {
        return [
          'allowedBlocks' => [
            'acf/heading'
          ]
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $faq = new FieldsBuilder('faq');

        return $faq->build();
    }
}
