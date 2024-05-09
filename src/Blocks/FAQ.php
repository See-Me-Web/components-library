<?php

namespace Seeme\Components\Blocks;

use Illuminate\Support\Str;
use Seeme\Components\Blocks\Abstract\BaseBlock;
use Seeme\Components\Providers\CoreServiceProvider;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Faq extends BaseBlock
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Faq';

    /**
     * The block view.
     */
    public $view = CoreServiceProvider::NAMESPACE . '::blocks.faq';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'FAQ section with questions and anserws grouped in topics';

    /**
     * The block icon.
     *
     * @var string|array
     */
    public $icon = 'info';

    /**
     * The block keywords.
     *
     * @var array
     */
    public $keywords = [
        'faq'
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
          'blockGap' => true,
        ],
        'color' => [
            'text' => true,
            'background' => false
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
          'groups' => $this->getGroups(),
          'allowedBlocks' => [
            'core/paragraph',
            'acf/heading'
          ]
        ];
    }

    public function getGroups(): array
    {
        return array_map(fn ($group) => [
            'slug' => Str::slug($group['title'] ?? ''),
            ...$group
        ], get_field('groups') ?: []);
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function getBlockFields(): FieldsBuilder
    {
        $builder = new FieldsBuilder('faq');

        $builder
            ->addAccordion('Ustawienia bloku')
            ->addFlexibleContent('groups', [
                'button_label' => 'Dodaj grupę'
            ])
                ->addLayout($this->getGroupLayout(), [
                    'label' => 'Grupa'
                ])
            ->endFlexibleContent();

        return $builder;
    }

    public function getGroupLayout(): FieldsBuilder
    {
        $builder = new FieldsBuilder('faq-group');

        $builder
            ->addText('title', [
                'label' => 'Tytuł grupy'
            ])
            ->addFlexibleContent('items', [
                'button_label' => 'Dodaj element'
            ])
                ->addLayout($this->getItemLayout(), [
                    'label' => 'Element'
                ])
            ->endFlexibleContent();

        return $builder;
    }

    public function getItemLayout(): FieldsBuilder
    {
        $builder = new FieldsBuilder('faq-item');

        $builder
            ->addText('title', [
                'label' => 'Tytuł'
            ])
            ->addWysiwyg('content', [
                'label' => 'Treść'
            ]);

        return $builder;
    }
}
