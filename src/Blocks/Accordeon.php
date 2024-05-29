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
            'slug' => 'accordeon',
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
                    'background' => false,
                    'text' => true,
                ],
                'spacing' => [
                    'padding' => ['top', 'bottom'],
                    'margin' => ['top', 'bottom'],
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
            'open' => get_field('open'),
            'title' => get_field('title') ?: '',
            'simple' => get_field('simple') ?: false,
            'allowedBlocks' => [
                'core/paragraph',
                'core/list',
                'core/table',
                'core/image',
                'acf/download',
                'acf/icon',
                'acf/stack',
                'acf/button',
                'acf/heading',
                'acf/socials'
            ],
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
        ->addText('title', [
          'label' => 'Tytuł'
        ])
        ->addTrueFalse('open', [
          'label' => 'Domyślnie otwarte',
          'default_value' => false
        ])
        ->addTrueFalse('simple', [
            'label' => 'Minimalistyczny wygląd',
            'default_value' => false
        ]);

        return $builder;
    }
}