<?php

namespace Seeme\Components\Blocks;

use Seeme\Components\Blocks\Abstract\BaseBlock;
use Seeme\Components\Providers\CoreServiceProvider;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Gallery extends BaseBlock
{
    /**
     * The block view path.
     */
    public $view = CoreServiceProvider::NAMESPACE . '::blocks.gallery';

    /**
     * The block attributes.
     */
    public function attributes(): array
    {
        return [
            'slug' => 'gallery',
            'name' => __('Gallery', 'sm-components'),
            'description' => __('Grid gallery', 'sm-components'),
            'icon' => 'format-gallery',
            'keywords' => ['images', 'gallery'],
            'post_types' => [],
            'parent' => [],
            'mode' => 'preview',
            'supports' => [
                'align' => false,
                'align_text' => false,
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
                ],
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
          'columns' => get_field('columns') ?: 3,
          'mobileColumns' => get_field('mobile-columns') ?: 1,
          'allowedBlocks' => [
            'acf/gallery-item'
          ]
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function getBlockFields(): FieldsBuilder
    {
        $builder = new FieldsBuilder('gallery');

        $builder
          ->addAccordion('Ustawienia bloku')
          ->addRange('columns', [
            'label' => 'Liczba kolumn',
            'min' => 1,
            'max' => 6,
            'step' => 1,
            'default_value' => 3
          ])
          ->addRange('mobile-columns', [
            'label' => 'Liczba kolumn dla urządzeń mobilnych',
            'min' => 1,
            'max' => 6,
            'step' => 1,
            'default_value' => 1,
          ]);
        
        return $builder;
    }

    public function getAdditionalClasses(): array
    {
      return [
        "grid-cols-[--mobile-columns]",
        "md:grid-cols-[--columns]"
      ];
    }

    public function getAdditionalStyles(): array
    {
      $columns = get_field('columns') ?: 3;
      $mobileColumns = get_field('mobile-columns') ?: 1;

      return [
        "--columns: repeat({$columns}, minmax(0, 1fr))",
        "--mobile-columns: repeat({$mobileColumns}, minmax(0, 1fr))",
      ];
    }
}
