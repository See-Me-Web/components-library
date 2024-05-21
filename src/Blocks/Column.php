<?php

namespace Seeme\Components\Blocks;

use Seeme\Components\Blocks\Abstract\BaseBlock;
use Seeme\Components\Providers\CoreServiceProvider;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Column extends BaseBlock
{
    /**
     * The block view path.
     */
    public $view = CoreServiceProvider::NAMESPACE . '::blocks.column';

    /**
     * The block attributes.
     */
    public function attributes(): array
    {
        return [
            'name' => __('Column', 'sm-components'),
            'description' => __('Column block', 'sm-components'),
            'icon' => 'columns',
            'keywords' => ['columns'],
            'post_types' => [],
            'parent' => ['acf/columns'],
            'mode' => 'preview',
            'supports' => [
                'align' => false,
                'align_text' => false,
                'align_content' => false,
                'full_height' => false,
                'anchor' => false,
                'mode' => false,
                'multiple' => true,
                'jsx' => true,
                'color' => [
                    'background' => false,
                    'text' => false,
                ],
                'spacing' => [
                  'margin' => false,
                  'padding' => true,
                ]
            ],
        ];
    }

    /**
     * Data to be passed to the block before rendering.
     */
    public function getWith(): array
    {
        return [];
    }

    /**
     * The block field group.
     */
    public function getBlockFields(): FieldsBuilder
    {
        $builder = new FieldsBuilder('column');
        return $builder;
    }

}