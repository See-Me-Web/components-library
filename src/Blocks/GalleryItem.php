<?php

namespace Seeme\Components\Blocks;

use Seeme\Components\Blocks\Abstract\BaseBlock;
use Seeme\Components\Helpers\ViewHelper;
use Seeme\Components\Providers\CoreServiceProvider;
use StoutLogic\AcfBuilder\FieldsBuilder;

class GalleryItem extends BaseBlock
{
    /**
     * The block view path.
     */
    public $view = CoreServiceProvider::NAMESPACE . '::blocks.gallery-item';

    /**
     * The block attributes.
     */
    public function attributes(): array
    {
        return [
            'slug' => 'gallery-item',
            'name' => __('Gallery item', 'sm-components'),
            'description' => __('Gallery item', 'sm-components'),
            'icon' => 'format-gallery',
            'keywords' => ['images', 'gallery'],
            'post_types' => [],
            'parent' => ['acf/gallery'],
            'mode' => 'preview',
            'uses_context' => ['parentData'],
            'supports' => [
                'align' => false,
                'align_text' => false,
                'align_content' => false,
                'full_height' => false,
                'anchor' => true,
                'mode' => true,
                'multiple' => true,
                'jsx' => false,
                'spacing' => [
                    'padding' => ['top', 'bottom'],
                    'margin' => ['top', 'bottom'],
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
        $image = get_field('image');

        if( !$image ) {
          return [];
        }
        
        $parentData = $this->context['parentData'] ?? [];

        return [
          'image' => ViewHelper::prepareImage($image, 'large'),
          'parentAnchor' => $parentData['anchor'] ?? '',
          'width' => get_field('width') ?: 1,
          'blockVariant' => $parentData['variant'] ?? 'primary'
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function getBlockFields(): FieldsBuilder
    {
        $builder = new FieldsBuilder($this->getSlug());

        $builder
          ->addAccordion('Ustawienia bloku')
          ->addImage('image', [
            'label' => 'Zdjęcie',
            'return_format' => 'id'
          ])
          ->addRange('width', [
            'label' => 'Szerokość kafelka',
            'min' => 1,
            'max' => 6,
            'default_value' => 1,
            'append' => 'kolumn(a)'
          ]);
        
        return $builder;
    }

    public function getAdditionalClasses(): array
    {
      return [
        "md:col-[--item-width]"
      ];
    }

    public function getAdditionalStyles(): array
    {
      $width = get_field('width') ?: 1;

      return [
        "--item-width: span {$width}"
      ];
    }
}
