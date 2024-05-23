<?php

namespace Seeme\Components\Blocks;

use Log1x\AcfComposer\AcfComposer;
use Seeme\Components\Blocks\Abstract\BaseBlock;
use Seeme\Components\Partials\Variant;
use Seeme\Components\Providers\CoreServiceProvider;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Card extends BaseBlock
{
    /**
     * Array of partials used by this block.
     */
    public array $partials = [];

    /**
     * The block view path.
     */
    public $view = CoreServiceProvider::NAMESPACE . '::blocks.card';

    /**
     * The block constructor.
     */
    public function __construct(AcfComposer $composer)
    {
        $this->partials = [
            'variant' => new Variant()
        ];

        parent::__construct($composer);
    }
  
    /**
     * The block attributes.
     */
    public function attributes(): array
    {
        return [
            'slug' => 'card',
            'name' => __('Card', 'sm-components'),
            'description' => __('Card block', 'sm-components'),
            'icon' => 'format-aside',
            'keywords' => ['card'],
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
        'variant' => $this->partials['variant']->getVariant()
      ];
    }

    /**
     * The block field group.
     */
    public function getBlockFields(): FieldsBuilder
    {
        $builder = new FieldsBuilder($this->getSlug());
        
        $builder
          ->addFields($this->partials['variant']->fields());

        return $builder;
    }

}