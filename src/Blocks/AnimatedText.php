<?php

namespace Seeme\Components\Blocks;

use Seeme\Components\Blocks\Abstract\BaseBlock;
use Seeme\Components\Providers\CoreServiceProvider;
use StoutLogic\AcfBuilder\FieldsBuilder;

class AnimatedText extends BaseBlock
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'AnimatedText';

    /**
     * The block view.
     */
    public $view = CoreServiceProvider::NAMESPACE . '::blocks.animated-text';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Text animated with scroll of the page';

    /**
     * The block icon.
     *
     * @var string|array
     */
    public $icon = 'heading';

    /**
     * The block keywords.
     *
     * @var array
     */
    public $keywords = [
        'animated'
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
        'jsx' => false,
        'spacing' => [
            'padding' => ['top', 'bottom'],
            'margin' => ['top', 'bottom'],
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
            'text' => get_field('text') ?: '',
            'speedFactor' => (float) get_field('speedFactor'),
            'fontSize' => get_field('fontSize') ?: 17,
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function getBlockFields(): FieldsBuilder
    {
        $builder = new FieldsBuilder('animated-text');

        $builder
          ->addAccordion('Ustawienia bloku')
          ->addTextarea('text', [
              'label' => 'Tekst',
              'rows' => 3,
              'new_lines' => 'br'
          ])
          ->addRange('speedFactor', [
            'label' => 'Czynnik szybkości',
            'instructions' => 'Im większa liczba tym tekst szybciej przesunie się poza ekran',
            'step' => 0.1,
            'min' => 0,
            'max' => 5,
            'default_value' => 1.5
          ])
          ->addRange('fontSize', [
            'label' => 'Wielkość tekstu',
            'min' => 1,
            'max' => 30,
            'step' => 0.5,
            'append' => 'vw',
            'default_value' => 17
          ]);

        return $builder;
    }

    public function getAdditionalStyles(): array
    {
        $fontSize = get_field('fontSize') ?: 17;

        return [
            "--font-size: {$fontSize}vw"
        ];
    }
}
