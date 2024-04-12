<?php

namespace Seeme\Components\Blocks;

use Seeme\Components\Blocks\Abstract\BaseBlock;
use Seeme\Components\Helpers\ButtonHelper;
use Seeme\Components\Providers\CoreServiceProvider;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Button extends BaseBlock
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Button';

    /**
     * The block view.
     */
    public $view = CoreServiceProvider::NAMESPACE . '::blocks.button';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Button';

    /**
     * The block icon.
     *
     * @var string|array
     */
    public $icon = 'button';

    /**
     * The block keywords.
     *
     * @var array
     */
    public $keywords = [
        'button'
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
    public $parent = [
        'acf/buttons',
        'acf/column-links-item',
    ];

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
        'jsx' => false,
        'spacing' => [
            'padding' => ['top', 'bottom'],
            'margin' => ['top', 'bottom'],
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
            'link' => get_field('link') ?: [],
            'variant' => get_field('variant') ?: ButtonHelper::getDefaultVariant(),
            'size' => get_field('size') ?: ButtonHelper::getDefaultSize(),
            'iconLeft' => get_field('iconLeft') ?: false,
            'iconRight' => get_field('iconRight') ?: false,
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
        $button = new FieldsBuilder('button');

        $button
          ->addLink('link')
          ->addSelect('variant', [
            'label' => 'Wariant',
            'choices' => ButtonHelper::getOptions(ButtonHelper::getVariants()),
            'default_value' => ButtonHelper::getDefaultVariant()
          ])
          ->addSelect('size', [
            'label' => 'Rozmiar',
            'choices' => ButtonHelper::getOptions(ButtonHelper::getSizes()),
            'default_value' => ButtonHelper::getDefaultSize()
          ])
          ->addImage('iconLeft', [
            'label' => 'Icon before text',
          ])
          ->addImage('iconRight', [
            'label' => 'Icon after text',
          ]);

        return $button->build();
    }
}
