<?php

namespace Seeme\Components\Blocks;

use Seeme\Components\Blocks\Abstract\BaseBlock;
use Seeme\Components\Providers\CoreServiceProvider;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Column extends BaseBlock
{
    public $category = 'sm-blocks-layout';
    
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
            'slug' => 'column',
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
        return [
            'colSpan' => get_field('col-span') ?: 1
        ];
    }

    /**
     * The block field group.
     */
    public function getBlockFields(): FieldsBuilder
    {
        $builder = new FieldsBuilder($this->getSlug());

        $builder
            ->addAccordion('Ustawienia bloku')
            ->addRange('col-span', [
                'label' => 'Szerokość kolumny',
                'min' => 1,
                'step' => 1,
                'max' => 10
            ]);

        return $builder;
    }

    public function getAdditionalClasses(): array
    {
        return [
            "col-[--col-span]"
        ];
    }

    public function getAdditionalStyles(): array
    {
        $colSpan = get_field('col-span') ?: 1;
        
        return [
            "--col-span: span {$colSpan}"
        ];
    }

}