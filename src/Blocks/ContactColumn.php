<?php

namespace Seeme\Components\Blocks;

use Seeme\Components\Blocks\Abstract\BaseBlock;
use Seeme\Components\Providers\CoreServiceProvider;
use StoutLogic\AcfBuilder\FieldsBuilder;

class ContactColumn extends BaseBlock
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Contact column';

    /**
     * The block view.
     */
    public $view = CoreServiceProvider::NAMESPACE . '::blocks.contact-column';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Contact column';

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
        'contact',
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
    public $parent = [
      'acf/contact'
    ];

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
        'align_content' => true,
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
          'width' => get_field('width') ?: 50,
          'allowedBlocks' => [
            'acf/heading',
            'core/paragraph',
            'acf/buttons',
            'acf/accordeon',
            'acf/map',
            'acf/socials',
            'acf/icon'
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
        $builder = new FieldsBuilder('contact-column');

        $builder
          ->addAccordion('Ustawienia bloku')
            ->addRange('width', [
              'label' => 'Szerokość',
              'append' => '%',
              'min' => 5,
              'max' => 100,
              'step' => 5,
              'default_value' => 50
            ]);

        return $builder;
    }

    public function getAdditionalClasses(): array
    {
      return [];
    }

    public function getAdditionalStyles(): array
    {
      $width = get_field('width') ?: 50;

      return [
        "--width: {$width}%"
      ];
    }
}
