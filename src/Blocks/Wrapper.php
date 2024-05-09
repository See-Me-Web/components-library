<?php

namespace Seeme\Components\Blocks;

use Log1x\AcfComposer\AcfComposer;
use Seeme\Components\Blocks\Abstract\BaseBlock;
use Seeme\Components\Partials\Wrapper as PartialsWrapper;
use Seeme\Components\Providers\CoreServiceProvider;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Wrapper extends BaseBlock
{
    /**
     * Array of partials used by this block
     */
    public array $partials = [];

    public function __construct(AcfComposer $composer)
    {
        $this->partials = [
            'wrapper' => new PartialsWrapper()
        ];

        parent::__construct($composer);
    }

    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Wrapper';

    /**
     * The block view.
     */
    public $view = CoreServiceProvider::NAMESPACE . '::blocks.wrapper';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Wrapper';

    /**
     * The block icon.
     *
     * @var string|array
     */
    public $icon = 'editor-code';

    /**
     * The block keywords.
     *
     * @var array
     */
    public $keywords = [
        'wrapper'
    ];

    /**
     * The block post type allow list.
     *
     * @var array
     */
    public $post_types = [];

    /**
     * The parent block type allow list.
     *
     * @var array
     */
    public $parent = [];

    /**
     * The default block mode.
     *
     * @var string
     */
    public $mode = 'preview';

    /**
     * The default block alignment.
     *
     * @var string
     */
    public $align = 'center';

    /**
     * The default block text alignment.
     *
     * @var string
     */
    public $align_text = '';

    /**
     * The default block content alignment.
     *
     * @var string
     */
    public $align_content = '';

    /**
     * The supported block features.
     *
     * @var array
     */
    public $supports = [
        'align' => true,
        'align_text' => false,
        'align_content' => false,
        'full_height' => true,
        'anchor' => true,
        'mode' => true,
        'multiple' => true,
        'jsx' => true,
        'spacing' => [
          'padding' => true,
          'margin' => true
        ],
        'color' => [
          'text' => true,
          'background' => false
        ]
    ];

    /**
     * The block styles.
     *
     * @var array
     */
    public $styles = [];

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
        $builder = new FieldsBuilder('wrapper');

        $builder
          ->addFields($this->partials['wrapper']->fields());

        return $builder;
    }
}
