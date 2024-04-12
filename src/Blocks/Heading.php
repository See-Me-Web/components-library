<?php

namespace Seeme\Components\Blocks;

use Seeme\Components\Blocks\Abstract\BaseBlock;
use Seeme\Components\Helpers\HeadingHelper;
use Seeme\Components\Providers\CoreServiceProvider;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Heading extends BaseBlock
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Heading';

    /**
     * The block view.
     */
    public $view = CoreServiceProvider::NAMESPACE . '::blocks.heading';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Heading block';

    /**
     * The block icon.
     *
     * @var string|array
     */
    public $icon = 'heading';

    /**
     * The block keywords.
     *
     * @var array
     */
    public $keywords = [
        'heading'
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
        'anchor' => false,
        'mode' => false,
        'multiple' => true,
        'jsx' => true,
        'spacing' => [
            'padding' => true,
            'margin' => true,
        ],
        'typography' => [
            'fontSize' => true,
            'lineHeight' => true,
            'fontWeight' => true
        ],
        'color' => [
            'text' => true,
            'link' => false,
            'background' => false,
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
            'text' => get_field('text'),
            'size' => get_field('size') ?: HeadingHelper::getDefaultSize(),
            'element' => get_field('element') ?: 'h3',
            'weight' => get_field('weight') ?: HeadingHelper::getDefaultWeight(),
            'style' => $this->getStyle()
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $heading = new FieldsBuilder('heading');

        $heading
            ->addTextarea('text', [
                'label' => 'Tekst',
                'rows' => 3,
                'new_lines' => 'br'
            ])
            ->addSelect('size', [
                'label' => 'Rozmiar',
                'choices' => HeadingHelper::getOptions(HeadingHelper::getSizes()),
                'default_value' => HeadingHelper::getDefaultSize()
            ])
            ->addSelect('element', [
                'choices' => [
                    'div' => 'Div',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                ],
                'default_value' => 'h3'
            ])
            ->addSelect('weight', [
                'label' => 'Grubość czcionki',
                'choices' => HeadingHelper::getOptions(HeadingHelper::getWeights()),
                'default_value' => HeadingHelper::getDefaultWeight()
            ]);

        return $heading->build();
    }
}
