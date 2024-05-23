<?php

namespace Seeme\Components\Blocks;

use Seeme\Components\Blocks\Abstract\BaseBlock;
use Seeme\Components\Providers\CoreServiceProvider;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Icon extends BaseBlock
{
    /**
     * The block view path.
     */
    public $view = CoreServiceProvider::NAMESPACE . '::blocks.icon';

    /**
     * The block attributes.
     */
    public function attributes(): array
    {
      return [
        'slug' => 'icon',
        'name' => __('Icon', 'sm-components'),
        'description' => __('Icon block', 'sm-components'),
        'icon' => 'twitter',
        'keywords' => ['icon'],
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
          'spacing' => [
            'padding' => true,
            'margin' => true,
          ],
          'color' => [
            'text' => true,
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
          'icon' => get_field('icon')
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
          ->addAccordion('Ustawienia bloku')
            ->addSelect('icon', [
              'label' => 'Ikona',
              'choices' => [
                'close' => 'Close',
                'chevron-down' => 'Chevron down',
                'chevron-up' => 'Chevron up',
                'chevron-left' => 'Chevron left',
                'chevron-right' => 'Chevron right',
                'download' => 'Download',
                'hamburger' => 'Hamburger',
                'map-marker' => 'Map marker',
                'envelope' => 'Envelope',
                'phone' => 'Phone',
                'socials.facebook' => 'Facebook',
                'socials.instagram' => 'Instagram',
                'socials.linkedin' => 'LinkedIn',
                'socials.tiktok' =>' TikTok',
                'socials.twitter' => 'Twitter',
                'socials.youtube' => 'YouTube'
              ]
            ])
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

    public function getAdditionalStyles(): array
    {
      $size = get_field('size') ?: 1;

      return [
        "--icon-size: {$size}rem"
      ];
    }
}
