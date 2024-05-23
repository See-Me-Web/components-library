<?php

namespace Seeme\Components\Blocks;

use Seeme\Components\Blocks\Abstract\BaseBlock;
use Seeme\Components\Providers\CoreServiceProvider;
use StoutLogic\AcfBuilder\FieldsBuilder;

class ContactColumn extends BaseBlock
{
    /**
     * The block view path.
     */
    public $view = CoreServiceProvider::NAMESPACE . '::blocks.contact-column';

    /**
     * The block attributes.
     */
    public function attributes(): array
    {
      return [
        'slug' => 'contact-column',
        'name' => __('Contact column', 'sm-components'),
        'description' => '',
        'icon' => 'tagcloud',
        'keywords' => ['contact'],
        'post_types' => [],
        'parent' => ['acf/contact'],
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
            'background' => false
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
          'width' => get_field('width') ?: 50,
          'allowedBlocks' => [
            'acf/heading',
            'core/paragraph',
            'acf/buttons',
            'acf/contact-accordeon',
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
        $builder = new FieldsBuilder($this->getSlug());

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

    public function getAdditionalStyles(): array
    {
      $width = get_field('width') ?: 50;

      return [
        "--width: {$width}%"
      ];
    }
}
