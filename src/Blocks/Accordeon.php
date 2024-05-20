<?php

namespace Seeme\Components\Blocks;

use Seeme\Components\Blocks\Abstract\BaseBlock;
use Seeme\Components\Providers\CoreServiceProvider;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Accordeon extends BaseBlock
{
    /**
     * The block view path.
     */
    public $view = CoreServiceProvider::NAMESPACE . '::blocks.accordeon';

    /**
     * The block attributes.
     */
    public function attributes(): array
    {
        return [
            'name' => __('Accordeon', 'sm-components'),
            'description' => __('A simple Accordeon block.', 'sage'),
            'icon' => 'editor-ul',
            'keywords' => [],
            'post_types' => [],
            'parent' => [],
            'ancestor' => [],
            'mode' => 'preview',
            'align' => '',
            'align_text' => '',
            'align_content' => '',
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
                    'background' => true,
                    'text' => true,
                    'gradient' => true,
                ],
            ],
        ];
    }

    /**
     * Data to be passed to the block before rendering.
     */
    public function getWith(): array
    {
        return [
            'items' => $this->items(),
        ];
    }

    /**
     * The block field group.
     */
    public function getBlockFields(): FieldsBuilder
    {
      $builder = new FieldsBuilder('accordeon');

      $builder
        ->addTab('Ustawienia bloku')
        ->addText('title', [
          'label' => 'Tytuł'
        ])
        ->addTrueFalse('open', [
          'label' => 'Domyślnie otwarte',
          'default_value' => false
        ]);

        return $builder;
    }
}