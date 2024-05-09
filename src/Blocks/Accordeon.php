<?php

namespace Seeme\Components\Blocks;

use Seeme\Components\Blocks\Abstract\BaseBlock;
use Seeme\Components\Providers\CoreServiceProvider;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Accordeon extends BaseBlock
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Accordeon';

    /**
     * The block view.
     */
    public $view = CoreServiceProvider::NAMESPACE . '::blocks.accordeon';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Accordeon';

    /**
     * The block icon.
     *
     * @var string|array
     */
    public $icon = 'tagcloud';

    /**
     * The block keywords.
     *
     * @var array
     */
    public $keywords = [
        'accordeon',
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
    public $align = '';

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
        ],
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
          'open' => get_field('open'),
          'title' => get_field('title') ?: '',
          'allowedBlocks' => [
            'core/paragraph',
            'acf/icon',
            'acf/icons'
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
        $builder = new FieldsBuilder('accordeon');

        $builder
          ->addAccordion('Ustawienia bloku')
          ->addText('title', [
            'label' => 'Tytuł'
          ])
          ->addTrueFalse('open', [
            'label' => 'Domyślnie otwarte',
            'default_value' => false
          ]);

        return $builder;
    }

    public function getAdditionalClasses(): array
    {
      return [];
    }

    public function getAdditionalStyles(): array
    {
      return [];
    }
}
