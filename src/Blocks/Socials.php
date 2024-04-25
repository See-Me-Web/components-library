<?php

namespace Seeme\Components\Blocks;

use Seeme\Components\Blocks\Abstract\BaseBlock;
use Seeme\Components\Providers\CoreServiceProvider;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Socials extends BaseBlock
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Socials';

    /**
     * The block view.
     */
    public $view = CoreServiceProvider::NAMESPACE . '::blocks.socials';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Socials';

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
        'section'
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
        'align_text' => true,
        'align_content' => false,
        'full_height' => false,
        'anchor' => true,
        'mode' => true,
        'multiple' => true,
        'jsx' => true,
        'spacing' => [
          'padding' => true,
          'margin' => true,
          'blockGap' => true
        ],
        'color' => [
          'background' => false,
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
          'socials' => get_field('socials') ?: []
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function getBlockFields(): FieldsBuilder
    {
        $builder = new FieldsBuilder('socials');

        $builder
          ->addAccordion('Ustawienia bloku')
          ->addFlexibleContent('socials')
            ->addLayout($this->getSocialLayout())
          ->endFlexibleContent()
          ->addRange('size', [
            'label' => 'Wielkość',
            'min' => 0.5,
            'step' => 0.5,
            'max' => 10,
            'append' => 'rem',
            'default_value' => 1
          ]);

        return $builder;
    }

    public function getSocialLayout(): FieldsBuilder
    {
      $builder = new FieldsBuilder('social');

      $builder
        ->addSelect('type', [
          'label' => 'Typ',
          'choices' => [
            'facebook' => 'Facebook',
            'instagram' => 'Instagram',
            'tiktok' => 'TikTok',
            'twitter' => 'Twitter',
            'youtube' => 'YouTube',
            'linkedin' => 'LinkedIn'
          ]
        ])
        ->addUrl('url');

      return $builder;
    }

    public function getAdditionalStyles(): array
    {
      $size = get_field('size') ?: 1;

      return [
        "--socials-size: {$size}rem"
      ];
    }
}
