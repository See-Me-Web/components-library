<?php

namespace Seeme\Components\Blocks;

use Log1x\AcfComposer\AcfComposer;
use Seeme\Components\Blocks\Abstract\BaseBlock;
use Seeme\Components\Partials\Heading as PartialsHeading;
use Seeme\Components\Providers\CoreServiceProvider;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Heading extends BaseBlock
{
    /**
     * The block styles.
     */
    public $styles_support = ['text'];

    /**
     * Array of partials used by this block.
     */
    public array $partials = [];

    /**
     * The block view path.
     */
    public $view = CoreServiceProvider::NAMESPACE . '::blocks.heading';

    /**
     * The block constructor.
     */
    public function __construct(AcfComposer $composer)
    {
        $this->partials = [
            'heading' => new PartialsHeading()
        ];

        parent::__construct($composer);
    }

    /**
     * The block attributes.
     */
    public function attributes(): array
    {
        return [
            'name' => __('Heading', 'sm-components'),
            'description' => __('Heading block', 'sm-components'),
            'icon' => 'heading',
            'keywords' => ['heading'],
            'post_types' => [],
            'parent' => [],
            'mode' => 'preview',
            'supports' => [
                'align' => false,
                'align_text' => true,
                'align_content' => false,
                'full_height' => false,
                'anchor' => true,
                'mode' => false,
                'multiple' => true,
                'jsx' => true,
                'spacing' => [
                    'padding' => true,
                    'margin' => true,
                ],
                'color' => [
                    'text' => true,
                    'link' => false,
                    'background' => false,
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
            ...$this->partials['heading']->getVariables(),
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function getBlockFields(): FieldsBuilder
    {
        $builder = new FieldsBuilder('heading');

        $builder
            ->addFields($this->partials['heading']->fields());

        return $builder;
    }
}
