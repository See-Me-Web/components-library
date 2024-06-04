<?php

namespace Seeme\Components\Blocks;

use Seeme\Components\Blocks\Abstract\BaseBlock;
use Seeme\Components\Providers\CoreServiceProvider;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Stack extends BaseBlock
{
    public $category = 'sm-blocks-layout';

    public $classes_map = [
      'alignfull' => '[&.is-horizontal]:justify-stretch [&.is-vertical]:items-stretch',
      'alignleft' => '[&.is-horizontal]:justify-start [&.is-vertical]:items-start',
      'aligncenter' => '[&.is-horizontal]:justify-center [&.is-vertical]:items-center',
      'alignright' => '[&.is-horizontal]:justify-end [&.is-vertical]:items-end',
    ];

    /**
     * The block view path.
     */
    public $view = CoreServiceProvider::NAMESPACE . '::blocks.stack';

    /**
     * The block attributes.
     */
    public function attributes(): array
    {
        return [
            'slug' => 'stack',
            'name' => __('Stack', 'sm-components'),
            'description' => __('Stack block', 'sm-components'),
            'icon' => 'screenoptions',
            'keywords' => ['stack'],
            'post_types' => [],
            'parent' => [],
            'mode' => 'preview',
            'supports' => [
                'align' => true,
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
                  'margin' => true,
                  'padding' => true,
                  'blockGap' => true
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
          'vertical' => $this->isVertical()
        ];
    }

    public function isVertical(): bool
    {
      $vertical = get_field('vertical');
      return $vertical === null ? false : $vertical;
    }

    public function getAdditionalClasses(): array
    {
      if($this->isVertical()) {
        return ['is-vertical'];
      } else {
        return ['is-horizontal'];
      }
    }

    /**
     * The block field group.
     */
    public function getBlockFields(): FieldsBuilder
    {
      $builder = new FieldsBuilder($this->getSlug());

      $builder
        ->addAccordion('Ustawienia bloku')
        ->addTrueFalse('vertical', [
          'label' => 'Kierunek',
          'ui_on_text' => 'Pionowo',
          'ui_off_text' => 'Poziomo',
        ]);
        
        return $builder;
    }
}