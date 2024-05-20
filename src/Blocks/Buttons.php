<?php

namespace Seeme\Components\Blocks;

use Seeme\Components\Blocks\Abstract\BaseBlock;
use Seeme\Components\Providers\CoreServiceProvider;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Buttons extends BaseBlock
{
    /**
     * The block classes map.
     */
    public $classes_map = [
        'align-text-left' => 'justify-start',
        'align-text-center' => 'justify-center',
        'align-text-right' => 'justify-end',
    ];

    /**
     * The block view path.
     */
    public $view = CoreServiceProvider::NAMESPACE . '::blocks.buttons';

    /**
     * The block attributes.
     */
    public function attributes(): array
    {
        return [
            'name' => __('Buttons', 'sm-components'),
            'description' => '',
            'icon' => 'button',
            'keywords' => ['buttons'],
            'post_types' => [],
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
                    'padding' => ['top', 'bottom'],
                    'margin' => ['top', 'bottom'],
                    'blockGap' => true
                ]
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
            'allowedBlocks' => [
                'acf/button'
            ],
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function getBlockFields(): FieldsBuilder
    {
        $builder = new FieldsBuilder('buttons');
        
        return $builder;
    }
}
