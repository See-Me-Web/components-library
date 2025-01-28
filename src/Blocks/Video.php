<?php

namespace Seeme\Components\Blocks;

use Seeme\Components\Blocks\Abstract\BaseBlock;
use Seeme\Components\Providers\CoreServiceProvider;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Video extends BaseBlock
{
    public $category = 'sm-blocks';

    public $classes_map = [
      'alignfull' => '[&.is-horizontal]:justify-stretch [&.is-vertical]:items-stretch',
      'alignleft' => '[&.is-horizontal]:justify-start [&.is-vertical]:items-start',
      'aligncenter' => '[&.is-horizontal]:justify-center [&.is-vertical]:items-center',
      'alignright' => '[&.is-horizontal]:justify-end [&.is-vertical]:items-end',
    ];

    /**
     * The block view path.
     */
    public $view = CoreServiceProvider::NAMESPACE . '::blocks.video';

    /**
     * The block attributes.
     */
    public function attributes(): array
    {
        return [
            'slug' => 'video',
            'name' => __('Video', 'sm-components'),
            'description' => __('Video block', 'sm-components'),
            'icon' => 'format-video',
            'keywords' => ['video'],
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
                'color' => [
                    'background' => false,
                    'text' => false,
                ],
                'spacing' => [
                  'margin' => ['top', 'bottom'],
                  'padding' => ['top', 'bottom'],
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
        'video' => get_field('video') ?: []
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
        ->addFile('video');
        
        return $builder;
    }
}