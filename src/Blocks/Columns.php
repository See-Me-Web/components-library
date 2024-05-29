<?php

namespace Seeme\Components\Blocks;

use Seeme\Components\Blocks\Abstract\BaseBlock;
use Seeme\Components\Providers\CoreServiceProvider;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Columns extends BaseBlock
{
    public $category = 'sm-blocks-layout';

    /**
     * The block view path.
     */
    public $view = CoreServiceProvider::NAMESPACE . '::blocks.columns';

    /**
     * The block attributes.
     */
    public function attributes(): array
    {
        return [
            'slug' => 'columns',
            'name' => __('Columns', 'sm-components'),
            'description' => __('Columns block', 'sm-components'),
            'icon' => 'columns',
            'keywords' => ['columns'],
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
        $mobileVertical = get_field('mobile-vertical');

        return [
          'columns' => get_field('columns') ?: 2,
          'mobileVertical' => $mobileVertical == null ? true : $mobileVertical,
          'mobileColumns' => get_field('mobile-columns') ?: 1,
          'allowedBlocks' => [
            'acf/column'
          ],
          'template' => [
            [
              'acf/column'
            ],
            [
              'acf/column'
            ]
          ]
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
        ->addRange('columns', [
          'label' => 'Liczba kolumn',
          'min' => 1,
          'max' => 10,
          'default_value' => 2
        ])
        ->addTrueFalse('mobile-vertical', [
          'label' => 'Zmień orientację na pionową dla urządzeń mobilnych',
          'default_value' => true
        ])
        ->addRange('mobile-columns', [
          'label' => 'Liczba kolumn dla urządzeń mobilnych',
          'min' => 1,
          'max' => 6,
          'step' => 1,
          'default_value' => 1,
          'conditional_logic' => [
            [
              [
                'field' => 'mobile-vertical',
                'operator' => '==',
                'value' => 1
              ]
            ]
          ]
        ]);

        return $builder;
    }

    public function getAdditionalStyles(): array
    {
      $columns = get_field('columns') ?: 2;
      $mobileColumns = get_field('mobile-columns') ?: 1;

      return [
        "--columns: repeat({$columns}, minmax(0, 1fr))",
        "--mobile-columns: repeat({$mobileColumns}, minmax(0, 1fr))",
      ];
    }
}