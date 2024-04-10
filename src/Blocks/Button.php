<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Button extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Button';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'A simple Button block.';

    /**
     * The block category.
     *
     * @var string
     */
    public $category = 'proget';

    /**
     * The block icon.
     *
     * @var string|array
     */
    public $icon = 'screenoptions';

    /**
     * The block keywords.
     *
     * @var array
     */
    public $keywords = [];

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
    ];

    /**
     * The block styles.
     *
     * @var array
     */
    public $styles = [];

    /**
     * The block preview example data.
     *
     * @var array
     */
    public $example = [];

    /**
     * Data to be passed to the block before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'link' => get_field('link'),
            'style' => get_field('style') ?: 'primary',
            'size' => get_field('size') ?: 'medium',
            'iconBefore' => get_field('icon_left'),
            'iconAfter' => get_field('icon_right'),
            'customWidth' => get_field('custom_width'),
            'width' => get_field('width'),
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
          ->addText('test');

        return $button->build();
    }
}
