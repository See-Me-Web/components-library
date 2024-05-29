<?php

namespace Seeme\Components\Blocks;

use Log1x\AcfComposer\AcfComposer;
use Seeme\Components\Blocks\Abstract\BaseBlock;
use Seeme\Components\Partials\Wrapper as PartialsWrapper;
use Seeme\Components\Providers\CoreServiceProvider;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Wrapper extends BaseBlock
{
    public $category = 'sm-blocks-layout';

    /**
     * Array of partials used by this block.
     */
    public array $partials = [];

    /**
     * The block view path.
     */
    public $view = CoreServiceProvider::NAMESPACE . '::blocks.wrapper';

    /**
     * The block constructor.
     */
    public function __construct(AcfComposer $composer)
    {
        $this->partials = [
            'wrapper' => new PartialsWrapper()
        ];

        parent::__construct($composer);
    }

    /**
     * The block attributes.
     */
    public function attributes(): array
    {
      return [
        'slug' => 'wrapper',
        'name' => __('Wrapper', 'sm-components'),
        'description' => __('Wrapper block', 'sm-components'),
        'icon' => 'editor-code',
        'keywords' => ['wrapper'],
        'post_types' => [],
        'parent' => [],
        'mode' => 'preview',
        'supports' => [
          'align' => false,
          'align_text' => false,
          'align_content' => false,
          'full_height' => true,
          'anchor' => true,
          'mode' => true,
          'multiple' => true,
          'jsx' => true,
          'spacing' => [
            'padding' => true,
            'margin' => ['top', 'bottom']
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
          ...$this->partials['wrapper']->getVariables()
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
          ->addFields($this->partials['wrapper']->fields());

        return $builder;
    }
}
