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
            'description' => __('Accordeon block', 'sm-components'),
            'icon' => 'arrow-down-alt2',
            'keywords' => ['accordeon'],
            'post_types' => [],
            'parent' => [],
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
                    'background' => true,
                    'text' => true,
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
            'open' => get_field('open'),
            'title' => get_field('title') ?: '',
            'allowedBlocks' => [
                'acf/download',
                'acf/paragraph',
                'acf/icon',
            ],
        ];
    }

    /**
     * The block field group.
     */
    public function getBlockFields(): FieldsBuilder
    {
      $builder = new FieldsBuilder('accordeon');

      $builder
        ->addAccordion('Ustawienia bloku')
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