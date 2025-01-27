<?php

namespace Seeme\Components\Blocks;

use Seeme\Components\Blocks\Abstract\BaseBlock;
use Seeme\Components\Providers\CoreServiceProvider;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Map extends BaseBlock
{
    /**
     * The block view path.
     */
    public $view = CoreServiceProvider::NAMESPACE . '::blocks.map';

    /**
     * The block attributes.
     */
    public function attributes(): array
    {
      return [
        'slug' => 'map',
        'name' => __('Map', 'sm-components'),
        'description' => __('Map block', 'sm-components'),
        'icon' => 'location-alt',
        'keywords' => ['map'],
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
            'padding' => true,
            'margin' => true,
          ],
          'color' => [
            'text' => true,
            'background' => false
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
          'map' => get_field('map') ?: [],
          'markerIcon' => get_field('marker') ?: false,
        ];
    }

    /**
     * The block field group.
     *
     * @return FieldsBuilder
     */
    public function getBlockFields(): FieldsBuilder
    {
        $builder = new FieldsBuilder($this->getSlug());

        $builder
          ->addAccordion('Ustawienia bloku')
          ->addField('map', 'open_street_map', [
            'label' => 'Mapa',
            'center_lat'		=> 52.2328232,
            'center_lng'		=> 20.8963904,
            'return_format' => 'raw'
          ])
          ->addImage('marker', [
            'label' => 'Znacznik na mapie',
            'return_format' => 'url'
          ]);

        return $builder;
    }
}
